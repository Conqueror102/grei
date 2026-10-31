import { readFileSync, readdirSync, existsSync } from 'node:fs';
import { resolve } from 'node:path';
import { spawnSync } from 'node:child_process';

const root = process.cwd();
const walk = directory => readdirSync(directory, { withFileTypes: true }).flatMap(entry => {
  const file = resolve(directory, entry.name);
  return entry.isDirectory() ? walk(file) : [file];
});
const js = walk(resolve(root, 'resources/js')).filter(file => file.endsWith('.js'));
for (const file of js) {
  const result = spawnSync(process.execPath, ['--check', file], { encoding: 'utf8' });
  if (result.status) throw new Error(result.stderr);
}
const views = walk(resolve(root, 'resources/views'));
for (const file of views) {
  const markup = readFileSync(file, 'utf8');
  for (const match of markup.matchAll(/<x-grei\.([a-z-]+)/g)) {
    if (!existsSync(resolve(root, 'resources/views/components/grei', match[1] + '.blade.php'))) throw new Error('Missing component: ' + match[1]);
  }
  for (const match of markup.matchAll(/asset\('([^']+)'\)/g)) {
    if (!existsSync(resolve(root, 'public', match[1]))) throw new Error('Missing asset: ' + match[1]);
  }
}
console.log(`Checked ${js.length} JavaScript modules, ${views.length} Blade files, component references and local assets.`);

import { readFileSync, readdirSync, writeFileSync, existsSync, mkdirSync } from 'node:fs';
import { resolve } from 'node:path';

const root=process.cwd();
const walk=directory=>readdirSync(directory,{withFileTypes:true}).flatMap(entry=>entry.isDirectory()?walk(resolve(directory,entry.name)):[resolve(directory,entry.name)]);
const names=new Set(['arrow-up-right']);
for(const file of walk(resolve(root,'resources/views'))){
  const source=readFileSync(file,'utf8');
  for(const match of source.matchAll(/data-icon="([a-z0-9-]+)"|<x-grei\.icon\s+name="([a-z0-9-]+)"/g))names.add(match[1]||match[2]);
}
const symbols=[...names].sort().map(name=>{
  const file=resolve(root,'node_modules/@phosphor-icons/core/assets/regular',name+'.svg');
  if(!existsSync(file))throw new Error('Unknown Phosphor icon: '+name);
  const body=readFileSync(file,'utf8').replace(/^[\s\S]*?<svg[^>]*>/,'').replace(/<\/svg>\s*$/,'');
  return `<symbol id="${name}" viewBox="0 0 256 256">${body}</symbol>`;
});
mkdirSync(resolve(root,'public/assets'),{recursive:true});
writeFileSync(resolve(root,'public/assets/icons.svg'),`<svg xmlns="http://www.w3.org/2000/svg">${symbols.join('')}</svg>`);
const license=resolve(root,'node_modules/@phosphor-icons/core/LICENSE');
if(existsSync(license))writeFileSync(resolve(root,'public/assets/phosphor-license.txt'),readFileSync(license));
console.log(`Built ${names.size} official Phosphor symbols.`);

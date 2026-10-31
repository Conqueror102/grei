<?php
namespace Tests\Unit;
use App\Services\VideoEmbed;
use PHPUnit\Framework\TestCase;
class VideoEmbedTest extends TestCase {
    public function test_video_embeds_only_use_trusted_https_providers():void{
        $this->assertSame('https://www.youtube-nocookie.com/embed/abcdefghijk',VideoEmbed::url('https://www.youtube.com/watch?v=abcdefghijk'));
        $this->assertSame('https://player.vimeo.com/video/12345678',VideoEmbed::url('https://vimeo.com/12345678'));
        foreach(['javascript:alert(1)','http://youtube.com/watch?v=abcdefghijk','https://youtube.com.evil.test/watch?v=abcdefghijk','https://evil.test/video/12345678','https://youtube.com/watch?v[]=abcdefghijk'] as $url)$this->assertNull(VideoEmbed::url($url));
    }
}

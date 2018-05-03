<?php

namespace Peanut\ValuIncentive;

// TODO: やっていることはドメインに依存しないので、ライブラリとして切り出すのが良さそう
class Thumbnail
{
    private const MAX_WIDTH = 250;
    private const MAX_HEIGHT = 150;

    private $image;

    public static function create(ValuIncentive $incentive): self
    {
        $data = file_get_contents($incentive->image_url);
        if (!$data) {
            throw new \RuntimeException('failed to download image. [url] '.$incentive->image_url);
        }

        $originalImagge = imagecreatefromstring($data);
        if (!$originalImagge) {
            throw new \RuntimeException('failed to generate thumbnail from image');
        }

        $size = getimagesizefromstring($data);
        $originalWidth = $size[0];
        $originaHeight = $size[1];

        $thumbnail = new self();
        list($newWidth, $newHeight) = self::calculateNewImageSize($originalWidth, $originaHeight);
        $thumbnail->image = imagescale($originalImagge, $newWidth, $newHeight);

        return $thumbnail;
    }

    private static function calculateNewImageSize($width, $height)
    {

        $scale = ($width >= $height)
            ? self::MAX_WIDTH / $width
            : self::MAX_HEIGHT / $height;

        return [
            $width * $scale,
            $height * $scale,
        ];
    }

    public function __destruct()
    {
        imagedestroy($this->image);
    }

    public function toPng()
    {
        // 標準出力に吐いちゃうのでバッファリングして拾う
        ob_start();
        imagepng($this->image);
        $data = ob_get_contents();
        ob_end_clean();

        return $data;
    }
}
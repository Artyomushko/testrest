<?php

namespace App\Http;

use Psr\Http\Message\StreamInterface;

class Stream implements StreamInterface
{
    public function __construct(private $stream) {}

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        $this->seek(0);

        return $this->getContents();
    }

    /**
     * @inheritDoc
     */
    public function close(): void
    {
        fclose($this->stream);
        $this->detach();
    }

    /**
     * @inheritDoc
     */
    public function detach()
    {
        $stream = $this->stream;
        $this->stream = null;

        return $stream;
    }

    /**
     * @inheritDoc
     */
    public function getSize(): ?int
    {
        return stream_get_contents($this->stream)['size'];
    }

    /**
     * @inheritDoc
     */
    public function tell(): int
    {
        return ftell($this->stream);
    }

    /**
     * @inheritDoc
     */
    public function eof(): bool
    {
        return feof($this->stream);
    }

    /**
     * @inheritDoc
     */
    public function isSeekable(): bool
    {
        return $this->getMetadata('seekable');
    }

    /**
     * @inheritDoc
     */
    public function rewind(): void
    {
        $this->seek(0);
    }

    /**
     * @inheritDoc
     */
    public function seek(int $offset, int $whence = SEEK_SET): void
    {
        fseek($this->stream, $offset, $whence);
    }

    /**
     * @inheritDoc
     */
    public function isWritable(): bool
    {
        $mode = $this->getMetadata('mode');
        return strstr($mode, 'w') || strstr($mode, '+');
    }

    /**
     * @inheritDoc
     */
    public function write(string $string): int
    {
        return fwrite($this->stream, $string);
    }

    /**
     * @inheritDoc
     */
    public function isReadable(): bool
    {
        $mode = $this->getMetadata('mode');
        return strstr($mode, 'r') || strstr($mode, '+');
    }

    /**
     * @inheritDoc
     */
    public function read(int $length): string
    {
        return fread($this->stream, $length);
    }

    /**
     * @inheritDoc
     */
    public function getContents(): string
    {
        return stream_get_contents($this->stream);
    }

    /**
     * @inheritDoc
     */
    public function getMetadata(?string $key = null)
    {
        $metaData = stream_get_meta_data($this->stream);

        return $key ? ($metaData[$key] ?? null) : $metaData;
    }
}
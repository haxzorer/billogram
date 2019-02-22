<?php

declare(strict_types=1);

namespace Billogram\Model\Invoice;

use Billogram\Model\CreatableFromArray;

/**
 * @author Ibrahim Hizeoui <ibrahimhizeoui@gmail.com>
 */
class PDF implements CreatableFromArray
{
    /**
     * @var string
     */
    private $fileType;

    /**
     * @var string
     */
    private $content;

    /**
     * @return string
     */
    public function getFileType(): string
    {
        return $this->fileType;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return base64_decode($this->content);
    }

    public function toArray()
    {
        $data = parent::toArray();
        if (null !== $this->fileType) {
            $data['fileType'] = $this->fileType;
        }
        if (null !== $this->content) {
            $data['content'] = $this->content;
        }

        return $data;
    }

    public static function createFromArray(array $data)
    {
        if (isset($data['data'])) {
            $data = $data['data'];
        }

        $pdf = new self();
        $pdf->fileType = $data['fileType'] ?? null;
        $pdf->content = $data['content'] ?? null;

        return $pdf;
    }
}

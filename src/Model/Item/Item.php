<?php

declare(strict_types=1);

namespace Billogram\Model\Item;

/**
 * @author Ibrahim Hizeoui <ibrahimhizeoui@gmail.com>
 */
class Item extends BaseItem
{
    public static function createFromArray(array $data)
    {
        if (array_key_exists('data', $data)) {
            $itemArray = $data['data'];
        } else {
            $itemArray = $data;
        }
        $item = new self();
        $item->itemNo = $itemArray['item_no'] ?? null;
        $item->title = $itemArray['title'] ?? null;
        $item->description = $itemArray['description'] ?? null;
        $item->price = $itemArray['price'] ?? null;
        $item->vat = $itemArray['vat'] ?? null;
        $item->unit = $itemArray['unit'] ?? null;
        if (array_key_exists('bookkeeping', $itemArray)) {
            $item->bookkeeping = Bookkeeping::createFromArray($itemArray['bookkeeping']);
        }
        $item->createdAt = $itemArray['created_at'] ?? null;
        $item->updatedAt = $itemArray['updated_at'] ?? null;

        return $item;
    }
}

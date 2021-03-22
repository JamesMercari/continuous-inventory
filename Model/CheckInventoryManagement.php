<?php
namespace Mercari\ContinuousInventory\Model;

class CheckInventoryManagement implements \Mercari\ContinuousInventory\Api\CheckInventoryManagementInterface
{
    private $productRepository;
    private $stockRegistry;
    public function __construct(
    \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
    \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry
    ){
        $this->productRepository = $productRepository;
        $this->stockRegistry = $stockRegistry;
    }

    public function checkinventory($items)
    {
        //TODO
        $itemstocheck = json_decode($items);
        $returnarray = array();
        foreach($itemstocheck as $sku) {
            try {
                $item = $this->productRepository->get($sku)->getID();
            } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
                $item = "not found";
            }
            if ($item != "not found"){
                $productStock = $this->stockRegistry->getStockItem($item);
                $stock = $productStock->getQty();
            }else {
                $stock = '-1';
            }
            $returnarray[] = array(
                'sku' => $sku,
                'item' => $item,
                'stock' => $stock
            );
        }
        return json_encode($returnarray);
    }
}
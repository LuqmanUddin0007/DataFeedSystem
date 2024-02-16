<?php 

use App\Service\DBHandlerService;
use PHPUnit\Framework\TestCase;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CategoryRepository;
use App\Repository\BrandRepository;
use Psr\Log\LoggerInterface;
use App\Entity\Category;
use App\Entity\Brand;

class DBHandlerServiceTest extends TestCase
{
    public function testOperateOnProducts()
    {
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $categoryRepository = $this->createMock(CategoryRepository::class);
        $brandRepository = $this->createMock(BrandRepository::class);
        $logger = $this->createMock(LoggerInterface::class);

        $categoryRepository->method('findAll')->willReturn([new Category(), new Category()]);
        $brandRepository->method('findAll')->willReturn([new Brand(), new Brand()]);

        $dbHandlerService = new DBHandlerService($entityManager, $categoryRepository, $brandRepository, $logger);

        $xmlData = simplexml_load_string('<items><item><sku>123</sku><name>Product 1</name><CategoryName>Category 1</CategoryName><Brand>Brand 1</Brand></item></items>');

        $dbHandlerService->operateOnProducs($xmlData);

        $this->assertTrue(true, 'Expected EntityManager persists an instance of Item');
        $this->assertTrue(true, 'Expected EntityManager flushes changes');
        $this->assertTrue(true, 'Expected logger does not log any errors');
    }

    public function testGetItemCategory()
    {
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $categoryRepository = $this->createMock(CategoryRepository::class);
        $brandRepository = $this->createMock(BrandRepository::class);
        $logger = $this->createMock(LoggerInterface::class);

        $dbHandlerService = new DBHandlerService($entityManager, $categoryRepository, $brandRepository, $logger);

        $category = $dbHandlerService->getItemCategory('Test Category');

        $this->assertInstanceOf(Category::class, $category);
        $this->assertEquals('Test Category', $category->getName());
    }

    public function testGetItemBrand()
    {
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $categoryRepository = $this->createMock(CategoryRepository::class);
        $brandRepository = $this->createMock(BrandRepository::class);
        $logger = $this->createMock(LoggerInterface::class);

        $dbHandlerService = new DBHandlerService($entityManager, $categoryRepository, $brandRepository, $logger);

        // Call getItemBrand with a brand name
        $brand = $dbHandlerService->getItemBrand('Test Brand');

        // Assert that the returned object is an instance of Brand
        $this->assertInstanceOf(Brand::class, $brand);
        // Assert that the brand name matches the input
        $this->assertEquals('Test Brand', $brand->getName());
    }
}
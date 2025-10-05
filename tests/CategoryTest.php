<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Classes\Category;

final class CategoryTest extends TestCase
{
    public function testGetByNameReturnsDataForExistingCategory(): void
    {
        $category = new Category();
        $categoryData = $category->getByName('Food & Dining');

        $this->assertIsArray($categoryData);
        $this->assertEquals('Food & Dining', $categoryData['name']);
        $this->assertArrayHasKey('id', $categoryData);
        $this->assertGreaterThan(0, $categoryData['id']);
    }

    public function testGetByNameReturnsNullForUnknownCategory(): void
    {
        $category = new Category();
        $categoryData = $category->getByName('NonExistentCategory');

        $this->assertNull($categoryData);
    }
}

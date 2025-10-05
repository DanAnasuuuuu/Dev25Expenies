<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Classes\Expense;

final class ExpenseTest extends TestCase
{
    private \PDO $pdo;

    protected function setUp(): void
    {
        $this->pdo = new \PDO('mysql:host=localhost;dbname=dev25expenses', 'root', '');
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->pdo->beginTransaction();
    }

    protected function tearDown(): void
    {
        $this->pdo->rollBack();
    }

    public function testCreateInsertsValidExpense(): void
    {
        $expense = new Expense();

        $data = [
            'user_id' => 1,
            'category_id' => 1,
            'amount' => 2500,
            'date' => '2025-10-05'
        ];

        $result = $expense->create($data);

        $this->assertTrue($result);
    }
}

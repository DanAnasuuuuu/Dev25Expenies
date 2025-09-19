<?php

namespace App\Controllers;

use App\Classes\Expense;
use App\Classes\Category;
use App\Classes\View;

class ExpenseController {
    private Expense $expense;
    private Category $category;

    public function __construct() {
        $this->expense = new Expense();
        $this->category = new Category();
    }

    public function index(): void {
        $this->checkAuth();
        
        $userId = $_SESSION['user']['id'];
        $filters = [
            'category_id' => $_GET['category'] ?? null,
            'date' => $_GET['date'] ?? null
        ];

        $data = [
            'expenses' => $this->expense->getAllForUser($userId, $filters),
            'categories' => $this->category->getAll(),
            'monthlyTotal' => $this->expense->getMonthlyTotal($userId),
            'categoryTotals' => $this->expense->getTotalByCategory($userId)
        ];

        View::render('expenses', $data);
    }

    public function store(): void {
        $this->checkAuth();
        
        try {
            $expenseData = [
                'user_id' => $_SESSION['user']['id'],
                'category_id' => $_POST['category_id'],
                'amount' => $_POST['amount'],
                'date' => $_POST['date']
            ];

            if ($this->expense->create($expenseData)) {
                header('Location: /Dev25Expenies/public/expenses');
                exit;
            }

            throw new \Exception('Failed to create expense');
        } catch (\Exception $e) {
            View::render('expenses', [
                'error' => $e->getMessage(),
                'categories' => $this->category->getAll()
            ]);
        }
    }

    public function update(int $id): void {
        $this->checkAuth();
        
        try {
            $expenseData = [
                'user_id' => $_SESSION['user']['id'],
                'category_id' => $_POST['category_id'],
                'amount' => $_POST['amount'],
                'date' => $_POST['date']
            ];

            if ($this->expense->update($id, $expenseData)) {
                header('Location: /Dev25Expenies/public/expenses');
                exit;
            }

            throw new \Exception('Failed to update expense');
        } catch (\Exception $e) {
            View::render('expenses', [
                'error' => $e->getMessage(),
                'categories' => $this->category->getAll()
            ]);
        }
    }

    public function delete(int $id): void {
        $this->checkAuth();
        
        try {
            if ($this->expense->delete($id, $_SESSION['user']['id'])) {
                header('Location: /Dev25Expenies/public/expenses');
                exit;
            }

            throw new \Exception('Failed to delete expense');
        } catch (\Exception $e) {
            View::render('expenses', [
                'error' => $e->getMessage(),
                'categories' => $this->category->getAll()
            ]);
        }
    }

    private function checkAuth(): void {
        if (!isset($_SESSION['user'])) {
            header('Location: /Dev25Expenies/public/login');
            exit;
        }
    }
}

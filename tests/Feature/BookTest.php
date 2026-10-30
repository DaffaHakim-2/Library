<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    private function loginUser(): void
    {
        $this->actingAs(User::factory()->create());
    }

    private function createCategory(): Category
    {
        return Category::create([
            'name' => 'Programming',
            'description' => 'Kategori pemrograman',
        ]);
    }

    private function bookData(array $overrides = []): array
    {
        $category = Category::first() ?? $this->createCategory();

        return array_merge([
            'title' => 'Belajar Laravel 11',
            'author' => 'Asep',
            'category_id' => $category->id,
            'publisher' => 'Informatika',
            'year' => 2026,
            'isbn' => '9781234567890',
            'stock' => 10,
            'description' => 'Buku belajar Laravel.',
        ], $overrides);
    }

    private function createBook(): Book
    {
        $this->post(route('books.store'), $this->bookData());

        return Book::where('isbn', '9781234567890')->firstOrFail();
    }

    public function test_user_can_view_books(): void
    {
        $this->loginUser();

        $this->get(route('books.index'))
            ->assertOk();
    }

    public function test_user_can_create_book(): void
    {
        $this->loginUser();

        $this->post(route('books.store'), $this->bookData())
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('books', [
            'title' => 'Belajar Laravel 11',
            'isbn' => '9781234567890',
        ]);
    }

    public function test_user_can_view_book_detail(): void
    {
        $this->loginUser();

        $book = $this->createBook();

        $this->get(route('books.show', $book->id))
            ->assertOk()
            ->assertSee('Belajar Laravel 11');
    }

    public function test_user_can_update_book(): void
    {
        $this->loginUser();

        $book = $this->createBook();

        $this->put(route('books.update', $book->id), $this->bookData([
            'title' => 'Laravel 11 Lanjutan',
            'isbn' => '9789876543210',
        ]))->assertSessionHasNoErrors();

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => 'Laravel 11 Lanjutan',
            'isbn' => '9789876543210',
        ]);
    }

    public function test_user_can_delete_book(): void
    {
        $this->loginUser();

        $book = $this->createBook();

        $this->delete(route('books.destroy', $book->id));

        $this->assertDatabaseMissing('books', [
            'id' => $book->id,
        ]);
    }

    public function test_book_title_is_required(): void
    {
        $this->loginUser();

        $this->post(route('books.store'), $this->bookData([
            'title' => '',
        ]))->assertSessionHasErrors('title');
    }

    public function test_book_isbn_must_be_unique(): void
    {
        $this->loginUser();

        $this->createBook();

        $this->post(route('books.store'), $this->bookData([
            'title' => 'Buku Kedua',
        ]))->assertSessionHasErrors('isbn');
    }
}

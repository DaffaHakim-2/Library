<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
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

    private function categoryData(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Programming',
            'description' => 'Kategori buku pemrograman.',
        ], $overrides);
    }

    private function createCategory(): Category
    {
        $this->post(
            route('categories.store'),
            $this->categoryData()
        );

        return Category::where('name', 'Programming')->firstOrFail();
    }

    public function test_user_can_view_categories(): void
    {
        $this->loginUser();

        $this->get(route('categories.index'))
            ->assertOk();
    }

    public function test_user_can_create_category(): void
    {
        $this->loginUser();

        $this->post(route('categories.store'), $this->categoryData())
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('categories', [
            'name' => 'Programming',
        ]);
    }

    public function test_user_can_view_category_detail(): void
    {
        $this->loginUser();

        $category = $this->createCategory();

        $this->get(route('categories.show', $category->id))
            ->assertOk()
            ->assertSee('Programming');
    }

    public function test_user_can_update_category(): void
    {
        $this->loginUser();

        $category = $this->createCategory();

        $this->put(route('categories.update', $category->id), $this->categoryData([
            'name' => 'Web Development',
        ]))->assertSessionHasNoErrors();

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Web Development',
        ]);
    }

    public function test_user_can_delete_category(): void
    {
        $this->loginUser();

        $category = $this->createCategory();

        $this->delete(route('categories.destroy', $category->id));

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }

    public function test_category_name_is_required(): void
    {
        $this->loginUser();

        $this->post(route('categories.store'), $this->categoryData([
            'name' => '',
        ]))->assertSessionHasErrors('name');
    }

    public function test_category_name_must_be_unique(): void
    {
        $this->loginUser();

        $this->createCategory();

        $this->post(route('categories.store'), $this->categoryData())
            ->assertSessionHasErrors('name');
    }
}

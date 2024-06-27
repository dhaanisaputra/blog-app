<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use Illuminate\Support\Str;

class Categories extends Component
{
    public $category_name;
    public $selected_category_id;
    public $updateCategoryMode = false;
    public $categoryDelMode = false;

    public $subcategory_name;
    public $parent_category = 0;
    public $selected_subcategory_id;
    public $updateSubCategoryMode = false;

    protected $listeners = [
        'resetModalForm'
    ];

    public function resetModalForm()
    {
        $this->resetErrorBag();
        $this->category_name = null;
        $this->subcategory_name = null;
        $this->parent_category = null;
    }

    public function addCategory()
    {
        $this->validate([
            'category_name' => 'required|unique:categories,category_name',
        ]);

        $category = new Category();
        $category->category_name = $this->category_name;
        $saved = $category->save();

        if ($saved) {
            $this->dispatch('hideCategoriesModal');
            $this->showToastr('New Category has been added successfully', 'success');
        } else {
            $this->showToastr('Something went wrong', 'error');
        }
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        $this->selected_category_id = $category->id;
        $this->category_name = $category->category_name;
        $this->updateCategoryMode = true;
        $this->resetErrorBag();
        $this->dispatch('showcategoriesModal');
    }

    public function updateCategory()
    {
        if ($this->selected_category_id) {
            $this->validate([
                'category_name' => 'required|unique:categories,category_name',
            ]);

            $category = Category::findOrFail($this->selected_category_id);
            $category->category_name = $this->category_name;
            $updated = $category->save();

            if ($updated) {
                $this->dispatch('hideCategoriesModal');
                $this->updateCategoryMode = false;
                $this->showToastr('Category has been updated successfully', 'success');
            } else {
                $this->showToastr('Something went wrong', 'error');
            }
        }
    }

    public function addSubCategory()
    {
        $this->validate([
            'parent_category' => 'required',
            'subcategory_name' => 'required|unique:sub_categories,subcategory_name',
        ]);

        $subcategory = new SubCategory();
        $subcategory->subcategory_name = $this->subcategory_name;
        $subcategory->slug = Str::slug($this->subcategory_name);
        $subcategory->parent_category = $this->parent_category;
        $saved = $subcategory->save();

        if ($saved) {
            $this->dispatch('hideSubCategoriesModal');
            $this->parent_category = null;
            $this->subcategory_name = null;
            $this->showToastr('New Sub Category has been added successfully', 'success');
        } else {
            $this->showToastr('Something went wrong', 'error');
        }
    }

    public function editSubCategory($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $this->selected_subcategory_id = $subcategory->id;
        $this->parent_category = $subcategory->parent_category;
        $this->subcategory_name = $subcategory->subcategory_name;
        $this->updateSubCategoryMode = true;
        $this->resetErrorBag();
        $this->dispatch('showSubcategoriesModal');
    }

    public function updateSubCategory()
    {
        if ($this->selected_subcategory_id) {
            $this->validate([
                'parent_category' => 'required',
                'subcategory_name' => 'required|unique:sub_categories,subcategory_name,' .
                    $this->selected_subcategory_id
            ]);
            $subcategory = SubCategory::findOrFail($this->selected_subcategory_id);
            $subcategory->subcategory_name = $this->subcategory_name;
            $subcategory->slug = Str::slug($this->subcategory_name);
            $subcategory->parent_category = $this->parent_category;
            $updated = $subcategory->save();

            if ($updated) {
                $this->dispatch('hideSubCategoriesModal');
                $this->updateSubCategoryMode = false;
                $this->showToastr('Sub Category has been updated successfully', 'success');
            } else {
                $this->showToastr('Something went wrong', 'error');
            }
        }
    }

    public function deleteCategory($id)
    {
        $this->selected_category_id = $id;
    }

    public function deleteSubCategory($id)
    {
        $this->selected_subcategory_id = $id;
    }

    public function destroyCategory()
    {
        $category = Category::where('id', $this->selected_category_id)->first();
        $subcategory = SubCategory::where('parent_category', $category->id)->whereHas('posts')->with('posts')->get();

        if (!empty($subcategory) && count($subcategory) > 0) {
            $totalPosts = 0;
            foreach ($subcategory as $subcat) {
                $totalPosts += Post::where('category_id', $subcat->id)->get()->count();
            }
            $this->showToastr('This category has (' . $totalPosts . ') post related to it, cannot be deleted', 'error');
            $this->dispatch('close-modal');
        } else {
            SubCategory::where('parent_category', $category->id)->delete();
            $category->delete();

            $this->showToastr('Category has been deleted', 'info');
            $this->dispatch('close-modal');
        }
    }

    public function destroySubCategory()
    {
        $subcategory = SubCategory::where('id', $this->selected_subcategory_id)->first();
        $posts = Post::where('category_id', $subcategory->id)->get()->toArray();
        // dd('del sub cat');
        if (!empty($posts) && count($posts) > 0) {
            $this->showToastr('This sub category has (' . count($posts) . ') post related to it, cannot be deleted', 'error');
            $this->dispatch('close-modal-subCat');
        } else {
            $subcategory->delete();

            $this->showToastr('Sub Category has been deleted', 'info');
            $this->dispatch('close-modal-subCat');
        }
    }

    public function showToastr($message, $type)
    {
        return $this->dispatch('showToastr', [
            'type' => $type,
            'message' => $message
        ]);
    }

    public function render()
    {
        return view('livewire.categories', [
            'categories' => Category::orderBy('ordering', 'asc')->get(),
            'subcategories' => SubCategory::orderBy('ordering', 'asc')->get(),
        ]);
    }
}

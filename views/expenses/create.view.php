<?php
view('partials/header.php');
view('partials/sidebar.php');
$errors = $errors ?? [];
$categories = $categories ?? [];
?>

<body>
    <main class="ml-64 mt-12 p-6 bg-gray-100">
        <div class="bg-white rounded-lg shadow p-8 mt-4">
            <form action="/expenses" method="POST">
                <div class="flex flex-col gap-10">
                    <div class="flex justify-between items-center">
                        <h1>Add Expense</h1>
                        <!-- Modal Trigger -->
                        <button
                            type="button"
                            data-modal-target="crud-modal"
                            data-modal-toggle="crud-modal"
                            class="bg-red-500 text-white px-3 py-2 rounded flex items-center gap-1 hover:bg-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Add Category
                        </button>
                    </div>

                    <div>
                        <label for="date" class="block mb-2.5 text-sm font-medium text-heading">Date of Expense</label>
                        <input type="date" name="date" id="date" value="<?= date('Y-m-d') ?>" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2 shadow-xs placeholder:text-body" />
                        <?php if (isset($errors['date'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['date'] ?></p>
                        <?php endif ?>
                    </div>

                    <div>
                        <label for="category" class="block mb-2.5 text-sm font-medium text-heading">Choose a category</label>
                        <?php $selected = old('category_id'); ?>

                        <select
                            id="category"
                            name="category_id"
                            class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2 shadow-xs placeholder:text-body">
                            <option value="" disabled <?= empty($selected) ? 'selected' : '' ?>>
                                Select category
                            </option>

                            <?php foreach ($categories as $category): ?>
                                <option
                                    value="<?= $category['id'] ?>"
                                    <?= $selected == $category['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($category['category_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <?php if (isset($errors['category'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['category'] ?></p>
                        <?php endif ?>
                    </div>

                    <div>
                        <label for="cost" class="block mb-2.5 text-sm font-medium text-heading">Amount</label>
                        <input type="number" name="cost" value="<?= old('cost') ?>" id="cost" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2 shadow-xs placeholder:text-body"
                            placeholder="₱ 0.00">
                        <?php if (isset($errors['cost'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['cost'] ?></p>
                        <?php endif ?>
                    </div>

                    <div>
                        <label for="description" class="block mb-2.5 text-sm font-medium text-heading">Description</label>
                        <input type="text" name="description" value="<?= old('description') ?>" id="description" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2 shadow-xs placeholder:text-body">
                        <?php if (isset($errors['description_len'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['description_len'] ?></p>
                        <?php endif ?>
                    </div>

                    <button type="submit" class="text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 focus:outline-none">
                        Add Expense
                    </button>
                </div>
            </form>
        </div>
        <!-- Modal body -->
        <div id="crud-modal" class="hidden fixed inset-0 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                <form action="/categories" method="POST">
                    <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
                        <div class="flex items-center justify-between pb-4 md:pb-5">
                            <h3 class="text-lg font-medium text-heading">Add Category</h3>
                        </div>

                        <div class="col-span-2 sm:col-span-1">
                            <label for="modal-category_name" class="block mb-2.5 text-sm font-medium text-heading">Category name</label>
                            <input type="text" name="category_name" id="modal-category_name"
                                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body">
                        </div>

                        <div class="flex items-center space-x-4 border-t border-default pt-4 md:pt-6">
                            <button type="button" class="flex-1 bg-slate-500 text-white py-2 rounded" data-modal-hide="crud-modal">Cancel</button>
                            <button type="submit" class="flex-1 bg-blue-600 text-white py-2 rounded">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>
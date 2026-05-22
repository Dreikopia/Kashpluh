<?php

use Core\Session;

view('partials/header.php');
view('partials/sidebar.php');

// CHANGED: safe fallback so $expenses will never throw error if undefined
$expenses = $expenses ?? [];

$categories = $categories ?? [];

$errors = Session::get('errors') ?? [];

$editId = Session::get('edit_id');


?>

<main class="ml-64 mt-12 p-6">

    <table class="w-full border-collapse border border-slate-400 mt-4">

        <thead class="[&_th]:border [&_th]:border-slate-400 [&_th]:px-4 [&_th]:py-2 [&_th]:text-center">
            <tr>
                <th>Date of Expense</th>
                <th>Category</th>
                <th>Cost</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody class="[&_td]:border [&_td]:border-slate-400 [&_td]:px-4 [&_td]:py-2 [&_td]:align-middle [&_td]:text-center">

            <?php foreach ($expenses as $expense): ?>
                <tr>

                    <!-- CHANGED: safer date handling -->
                    <td>
                        <?= !empty($expense['date'])
                            ? date('M d, Y', strtotime($expense['date']))
                            : '' ?>
                    </td>

                    <!-- CHANGED: fallback if category missing -->
                    <td><?= $expense['category_name'] ?? 'No Category' ?></td>

                    <td> <span>₱ </span><?= $expense['cost'] ?? 0 ?></td>
                    <td><?= $expense['description'] ?? '' ?></td>

                    <td>

                        <!-- EDIT BUTTON (unchanged logic) -->
                        <button
                            data-modal-target="crud-modal-<?= $expense['id'] ?>"
                            data-modal-toggle="crud-modal-<?= $expense['id'] ?>"
                            class="bg-gray-600 px-3 py-1 text-white rounded hover:bg-gray-700"
                            type="button">
                            Edit
                        </button>

                        <!-- DELETE FORM (kept separate and clean) -->
                        <form action="/manage-list" method="POST" style="display:inline">

                            <!-- CHANGED: method spoofing for DELETE -->
                            <input type="hidden" name="_method" value="DELETE">

                            <input type="hidden" name="id" value="<?= $expense['id'] ?>">

                            <button
                                class="bg-red-600 px-3 py-1 text-white rounded hover:bg-red-700"
                                type="submit">
                                Delete
                            </button>
                        </form>

                        <!-- CHANGED: modal moved OUTSIDE DELETE form to prevent nesting issues -->
                        <!-- PATCH FORM (UPDATE EXPENSE) -->
                        <form action="/manage-list" method="POST">

                            <!-- CHANGED: method spoofing for PATCH -->
                            <input type="hidden" name="_method" value="PATCH">

                            <input type="hidden" name="id" value="<?= $expense['id'] ?>">

                            <!-- CHANGED: unique modal ID per row -->
                            <div
                                id="crud-modal-<?= $expense['id'] ?>"
                                class="<?= $editId == $expense['id'] ? '' : 'hidden' ?> fixed inset-0 flex items-center justify-center z-50">

                                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">

                                    <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">

                                        <!-- HEADER -->
                                        <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                                            <h3 class="text-lg font-medium text-heading">
                                                Edit List
                                            </h3>
                                        </div>

                                        <!-- FORM FIELDS -->
                                        <div class="grid gap-4 grid-cols-2 py-4 md:py-6">

                                            <!-- DATE -->
                                            <div class="col-span-2">
                                                <label class="block mb-2.5 text-sm font-medium text-heading">
                                                    Date
                                                </label>

                                                <input
                                                    type="date"
                                                    name="date"
                                                    value="<?= !empty($expense['date']) ? date('Y-m-d', strtotime($expense['date'])) : '' ?>"
                                                    class="bg-neutral-secondary-medium border border-default-medium text-sm rounded-base w-full px-3 py-2.5">
                                                <?php if (isset($errors['date'])): ?>
                                                    <p class="text-red-500 text-sm"> <?= $errors['date'] ?></p>
                                                <?php endif ?>
                                            </div>

                                            <!-- COST -->
                                            <div class="col-span-2 sm:col-span-1">
                                                <label class="block mb-2.5 text-sm font-medium text-heading">
                                                    Cost
                                                </label>

                                                <input
                                                    type="number"
                                                    name="cost"
                                                    value="<?= $expense['cost'] ?? 0 ?>"
                                                    class="bg-neutral-secondary-medium border border-default-medium text-sm rounded-base w-full px-3 py-2.5"
                                                    placeholder="₱ 0.00">
                                                <?php if (isset($errors['cost'])): ?>
                                                    <p class="text-red-500 text-sm"> <?= $errors['cost'] ?></p>
                                                <?php endif ?>
                                            </div>


                                            <!-- CATEGORY -->
                                            <div class="col-span-2 sm:col-span-1">
                                                <label class="block mb-2.5 text-sm font-medium text-heading">
                                                    Category
                                                </label>
                                                <?php $selected = $expense['category_id'] ?? ''; ?>

                                                <select
                                                    name="category_id"
                                                    class="w-full px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-sm rounded-base">

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
                                                    <?php if (isset($errors['category'])): ?>
                                                        <p class="text-red-500 text-sm"> <?= $errors['category'] ?></p>
                                                    <?php endif ?>
                                                </select>
                                            </div>

                                            <!-- DESCRIPTION -->
                                            <div class="col-span-2">
                                                <label class="block mb-2.5 text-sm font-medium text-heading">
                                                    Description
                                                </label>

                                                <textarea
                                                    name="description"
                                                    rows="4"
                                                    class="w-full p-3.5 bg-neutral-secondary-medium border border-default-medium text-sm rounded-base"><?= $expense['description'] ?? '' ?></textarea>
                                            </div>
                                            <?php if (isset($errors['description'])): ?>
                                                <p class="text-red-500 text-sm"><?= $errors['description'] ?></p>
                                            <?php endif ?>

                                        </div>

                                        <!-- ACTION BUTTONS -->
                                        <div class="flex items-center space-x-4 border-t border-default pt-4 md:pt-6">

                                            <!-- CHANGED: fixed modal hide ID -->
                                            <button
                                                type="button"
                                                class="flex-1 bg-slate-500 text-white py-2 rounded"
                                                data-modal-hide="crud-modal-<?= $expense['id'] ?>">
                                                Cancel
                                            </button>

                                            <button
                                                type="submit"
                                                class="flex-1 bg-blue-600 text-white py-2 rounded">
                                                Save
                                            </button>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>

                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

</main>
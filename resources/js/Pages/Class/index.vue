<template>
    <Head title="Halaman Daftar Kelas" />
    <AuthenticatedLayout :user="auth.user">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Halaman Pengelolaan Kelas
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-between items-center mb-4 mx-4">
                    <label htmlFor=""
                        >Total Data User: {{ classes.total }}</label
                    >
                    <Link
                        :href="route('classes.create')"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    >
                        Tambah Kelas
                    </Link>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="mt-8 flow-root">
                            <div
                                class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8"
                            >
                                <div
                                    class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
                                >
                                    <table
                                        class="min-w-full divide-y divide-gray-300"
                                    >
                                        <thead>
                                            <tr
                                                class="divide-x divide-gray-400"
                                            >
                                                <th
                                                    scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0"
                                                >
                                                    Number
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                >
                                                    Nama Kelas
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                >
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-if="
                                                    classes && classes.total > 0
                                                "
                                                v-for="(
                                                    item, index
                                                ) in classes.data"
                                                :key="item.id"
                                                class="divide-x divide-gray-400"
                                            >
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0"
                                                >
                                                    {{ index + 1 }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                                >
                                                    {{ item.class_name }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 justify-between"
                                                >
                                                    <Link
                                                        :href="
                                                            route(
                                                                'classes.edit',
                                                                item.id
                                                            )
                                                        "
                                                        class="rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 mr-1"
                                                    >
                                                        Edit
                                                    </Link>
                                                    <button
                                                        @click="
                                                            deletePost(item.id)
                                                        "
                                                        class="rounded-md bg-red-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"
                                                    >
                                                        Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr v-else class="mx-auto">
                                                <td
                                                    class="whitespace-nowrap px-3 py-4 text-sm rounded-md bg-red-500 text-white text-center"
                                                    colspan="100%"
                                                >
                                                    Silahkan Isi Data Terlebih
                                                    Dahulu
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <Pagination :links="classes.links" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { computed } from "vue";
import { ref } from "vue";
import Pagination from "@/Components/Pagination.vue";

computed(() => ({
    getRowNumber(index) {
        return index + 1;
    },
}));

const form = useForm({});

const deletePost = (id) => {
    form.delete(`daftarkelas/${id}`);
};
// import Pagination from "@/Components/Pagination";

const props = defineProps({
    auth: Object,
    classes: Object,
    posts: {
        type: Array,
        default: () => [],
    },
});

const showDeleteConfirmation = ref(false);

const confirmUserDeletion = () => {
    showDeleteConfirmation.value = true;
};
</script>

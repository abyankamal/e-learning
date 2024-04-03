<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { Transition } from "vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextArea from "../../Components/TextArea.vue";
import SelectBox from "@/Components/SelectBox.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const form = useForm({
    name: "",
    description: "",
});

// Define a method to handle the change event from the SelectBox
const handleSelectionChange = (newValue) => {
    console.log("Selected value changed to:", newValue);
};

const onSubmit = (e) => {
    e.preventDefault();

    form.post(route("classes.store"), {
        preserveScroll: true,
        onSuccess: () => {
            alert("Class Sucess Created");
        },
        onError: (errors) => {
            console.log(errors);
        },
    });
};
</script>

<template>
    <Head title="Halaman Tambah Kelas" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tambah Kelas
            </h2>
        </template>

        <div className="py-12">
            <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    className="bg-white overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <div className="p-6 text-gray-900">
                        <div className="mt-8 flow-root">
                            <div
                                className="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8"
                            >
                                <div
                                    className="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
                                >
                                    <section className="max-w-xl">
                                        <header>
                                            <h2
                                                className="text-lg font-medium text-gray-900"
                                            >
                                                Tambah Kelas
                                            </h2>

                                            <p
                                                className="mt-1 text-sm text-gray-600"
                                            >
                                                Silahkan Masukan Data Kelas Yang
                                                Diperlukan
                                            </p>
                                        </header>

                                        <form
                                            @submit.prevent="onSubmit"
                                            class="mt-6 space-y-6"
                                        >
                                            <div>
                                                <InputLabel
                                                    for="name"
                                                    value="Nama"
                                                />

                                                <TextInput
                                                    id="name"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                    v-model="form.name"
                                                    required
                                                    autofocus
                                                    autocomplete="name"
                                                />

                                                <InputError
                                                    class="mt-2"
                                                    :message="form.errors.name"
                                                />
                                            </div>

                                            <div>
                                                <InputLabel
                                                    for="password"
                                                    value="Password"
                                                />

                                                <TextArea
                                                    id="description"
                                                    type="text"
                                                    v-model="description"
                                                    required
                                                    autocomplete="description"
                                                />

                                                <InputError
                                                    class="mt-2"
                                                    :message="
                                                        form.errors.password
                                                    "
                                                />
                                            </div>

                                            <div
                                                class="flex items-center gap-4"
                                            >
                                                <PrimaryButton
                                                    :disabled="form.processing"
                                                    >Simpan</PrimaryButton
                                                >

                                                <Transition
                                                    enter-active-class="transition ease-in-out"
                                                    enter-from-class="opacity-0"
                                                    leave-active-class="transition ease-in-out"
                                                    leave-to-class="opacity-0"
                                                >
                                                    <p
                                                        v-if="
                                                            form.recentlySuccessful
                                                        "
                                                        class="text-sm text-gray-600"
                                                    >
                                                        Saved.
                                                    </p>
                                                </Transition>
                                            </div>
                                        </form>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

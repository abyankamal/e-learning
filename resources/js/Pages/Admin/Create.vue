<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { Transition } from "vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import SelectBox from "@/Components/SelectBox.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import roles from "@/data/roles.json";

const roleAccount = roles;

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    role: "",
});

// Define a method to handle the change event from the SelectBox
const handleSelectionChange = (newValue) => {
    console.log("Selected value changed to:", newValue);
};

const onSubmit = (e) => {
    e.preventDefault();

    form.post(route("users.store"), {
        preserveScroll: true,
        onSuccess: () => {
            alert("User Sucess Created");
        },
        onError: (errors) => {
            console.log(errors);
        },
    });
};
</script>

<template>
    <Head title="Halaman Tambah Akun" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tambah Akun
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
                                                Tambah Akun
                                            </h2>

                                            <p
                                                className="mt-1 text-sm text-gray-600"
                                            >
                                                Silahkan Masukan Data Akun Yang
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
                                                    for="email"
                                                    value="Email"
                                                />

                                                <TextInput
                                                    id="email"
                                                    type="email"
                                                    class="mt-1 block w-full"
                                                    v-model="form.email"
                                                    required
                                                    autocomplete="username"
                                                />

                                                <InputError
                                                    class="mt-2"
                                                    :message="form.errors.email"
                                                />
                                            </div>

                                            <div>
                                                <InputLabel
                                                    for="password"
                                                    value="Password"
                                                />

                                                <TextInput
                                                    id="password"
                                                    type="password"
                                                    class="mt-1 block w-full"
                                                    v-model="form.password"
                                                    required
                                                    autocomplete="username"
                                                />

                                                <InputError
                                                    class="mt-2"
                                                    :message="
                                                        form.errors.password
                                                    "
                                                />
                                            </div>

                                            <div>
                                                <InputLabel
                                                    for="password"
                                                    value="Konfirmasi Password"
                                                />

                                                <TextInput
                                                    id="password"
                                                    type="password"
                                                    class="mt-1 block w-full"
                                                    v-model="
                                                        form.password_confirmation
                                                    "
                                                    required
                                                    autocomplete="username"
                                                />

                                                <InputError
                                                    class="mt-2"
                                                    :message="
                                                        form.errors
                                                            .password_confirmation
                                                    "
                                                />
                                            </div>

                                            <div>
                                                <InputLabel
                                                    for="password"
                                                    value="Role"
                                                />

                                                <SelectBox
                                                    id="role"
                                                    currentvalue="siswa"
                                                    v-model="form.role"
                                                    @change="
                                                        handleSelectionChange
                                                    "
                                                    :options="roleAccount"
                                                    className="mt-1 block w-full"
                                                />

                                                <InputError
                                                    class="mt-2"
                                                    :message="form.errors.role"
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

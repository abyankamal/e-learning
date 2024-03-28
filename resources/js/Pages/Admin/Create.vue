<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { Transition } from "vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    role: "",
});
</script>

<template>
    <Head title="Profile" />

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
                                                Profile Information
                                            </h2>

                                            <p
                                                className="mt-1 text-sm text-gray-600"
                                            >
                                                Update your account's profile
                                                information and email address.
                                            </p>
                                        </header>

                                        <form
                                            @submit.prevent="
                                                form.patch(
                                                    route('profile.update')
                                                )
                                            "
                                            class="mt-6 space-y-6"
                                        >
                                            <div>
                                                <InputLabel
                                                    for="name"
                                                    value="Name"
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

                                            <div
                                                v-if="
                                                    mustVerifyEmail &&
                                                    user.email_verified_at ===
                                                        null
                                                "
                                            >
                                                <p
                                                    class="text-sm mt-2 text-gray-800"
                                                >
                                                    Your email address is
                                                    unverified.
                                                    <Link
                                                        :href="
                                                            route(
                                                                'verification.send'
                                                            )
                                                        "
                                                        method="post"
                                                        as="button"
                                                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                    >
                                                        Click here to re-send
                                                        the verification email.
                                                    </Link>
                                                </p>

                                                <div
                                                    v-show="
                                                        status ===
                                                        'verification-link-sent'
                                                    "
                                                    class="mt-2 font-medium text-sm text-green-600"
                                                >
                                                    A new verification link has
                                                    been sent to your email
                                                    address.
                                                </div>
                                            </div>

                                            <div
                                                class="flex items-center gap-4"
                                            >
                                                <PrimaryButton
                                                    :disabled="form.processing"
                                                    >Save</PrimaryButton
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

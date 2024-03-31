<template>
    <section>
        <DangerButton @click="confirmUserDeletion">Hapus Akun</DangerButton>
        <Modal v-model="showDeleteDialog" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Are you sure you want to delete your account?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Once your account is deleted, all of its resources and data
                    will be permanently deleted. Please enter your password to
                    confirm you would like to permanently delete your account.
                </p>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal">
                        Cancel
                    </SecondaryButton>

                    <DangerButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Delete Account
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>

<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import Modal from "./Modal.vue";
import DangerButton from "./DangerButton.vue";
import SecondaryButton from "./SecondaryButton.vue";

const showDeleteDialog = ref(true);

const form = useForm({});

const props = defineProps({
    id: {
        type: Number,
        required: true,
    },
});

const confirmUserDeletion = () => {
    showDeleteDialog.value = true;
};

const deleteUser = () => {
    form.delete(route("users.destroy", props.id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => alert("Gagal Menghapus Akun"),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    showDeleteDialog.value = false;
};
</script>

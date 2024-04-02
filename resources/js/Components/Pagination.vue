<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    links: Array, // Define props for links as an array
});
</script>

<template>
    <div>
        <div class="flex items-center justify-between mt-4">
            <div v-for="(link, index) in links" :key="index">
                <Link
                    :href="link.url"
                    class="inline-flex items-center border-t-2 border-transparent px-4 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700"
                    v-bind:class="{
                        'border-indigo-500 text-indigo-600': link.active,
                    }"
                    v-html="link.label"
                />
            </div>
        </div>
    </div>
</template>

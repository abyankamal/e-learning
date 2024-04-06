<script setup>
import { ref, watch, computed } from "vue";

const props = defineProps({
    className: String,
    options: Array,
    currentValue: String,
});

// Define emitted events
const emit = defineEmits(["change"]); // Declare the 'change' event

const selectedValue = ref(props.currentValue);

const classes = computed(() => {
    return (
        "rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" +
        props.className
    );
});

watch(props, (updatedProps) => {
    selectedValue.value = updatedProps.currentValue;
});

const handleChange = (newValue) => {
    selectedValue.value = newValue;
    emit("change", newValue); // Emit the 'change' event with the new value
};
</script>

<template>
    <select
        :class="classes"
        v-model="selectedValue"
        :currentValue="selectedValue"
        @change="handleChange($event.target.value)"
    >
        <option v-for="option in options" :key="option.id" :value="option.id">
            {{ option.name }}
        </option>
    </select>
</template>

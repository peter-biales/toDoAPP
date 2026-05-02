<script setup lang="ts">

import { router, useForm } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    task: Object
});

const form = useForm({
    id: props.task?.id,
    title: props.task?.title,
    done: props.task?.done,
});

const edit = ref(false);

const editBtnText = computed(() => {
    if(edit.value) {
        return "Zrušiť";
    } else {
        return "Upraviť";
    }
});

function deleteTask(id: number) {
    router.delete(`/delete/${id}`);
}

function updateTask(mode: string) {
    
    if(mode == 'checkbox') {
        edit.value = false;
        form.done = !form.done;
        form.title = props.task?.title;
        form.put('/update');
    } else {
        form.put('/update');
        edit.value = !edit.value;
    }
}

function editBtnAction() {
    edit.value = !edit.value;
    form.title = props.task?.title;
}

</script>
<template>
    <input
        type="checkbox"
        v-model="form.done"
        :id="props.task?.id"
        @click="updateTask('checkbox')"
    >
    
    <label
        for="props.task?.id"
        @click="updateTask('checkbox')"
        class="taskTitle"
        :class="{hidden: edit}"
    >
        {{ props.task?.title }}
    </label>
    <input
        v-model="form.title"
        @keyup.enter="updateTask('')"
        type="text"
        :class="{hidden: !edit}"
    >
    
    <button
        @click="updateTask('')"
        :class="{hidden: !edit}"
    >
        Uložiť
    </button>
    <button @click="editBtnAction">{{ editBtnText }}</button>

    <button @click="deleteTask(form.id)">vymazať</button>
</template>
<style scoped>
    button, input[type="text"], input[type="checkbox"], .taskTitle {
        padding: 4px 8px;
        border: 1px solid black;
        margin: 2px 4px;
    }
    .taskTitle {
        border: none;
    }
    input[type="checkbox"] {
        width: 18px;
        height: 18px;
    }
</style>
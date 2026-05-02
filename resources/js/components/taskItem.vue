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
    <li class="flex flex-col gap-3 py-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex min-w-0 flex-1 items-center gap-3 cursor-default">
            <input
                type="checkbox"
                class="task-check h-5 w-5 rounded border-slate-300 text-blue-700 focus:ring-blue-100"
                v-model="form.done"
                :id="props.task?.id"
                @click="updateTask('checkbox')"
            />
            <span
                class="task-title min-w-0 flex-1 break-words font-medium"
                @click="updateTask('checkbox')"
                :class="{hidden: edit}"
            >
                {{ props.task?.title }}
            </span>
            <input
                type="text"
                maxlength="120"
                class="edit-input min-w-0 flex-1 rounded-lg border border-slate-300 px-3 py-2 outline-none transition focus:border-blue-600 focus:ring-4 focus:ring-blue-100"
                v-model="form.title"
                @keyup.enter="updateTask('')"
                :class="{hidden: !edit}"
            />
        </div>

        <div class="flex gap-2 sm:shrink-0">
            <button
                type="button"
                class="edit-btn rounded-lg border border-slate-300 px-3 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                @click="editBtnAction"
            >
                {{ editBtnText }}
            </button>
            <button
                type="button"
                class="save-btn rounded-lg bg-blue-700 px-3 py-2 text-sm font-semibold text-white transition hover:bg-blue-800"
                @click="updateTask('')"
                :class="{hidden: !edit}"
            >
                Uložiť
            </button>
            <button
                type="button"
                class="delete-btn rounded-lg border border-red-200 p-2 text-red-700 transition hover:bg-red-50"
                aria-label="Vymazať úlohu"
                title="Vymazať úlohu"
                @click="deleteTask(form.id)"
            >
                <svg
                    class="h-5 w-5"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    aria-hidden="true"
                >
                    <path d="M3 6h18" />
                    <path d="M8 6V4h8v2" />
                    <path d="M19 6l-1 14H6L5 6" />
                    <path d="M10 11v6" />
                    <path d="M14 11v6" />
                </svg>
            </button>
        </div>
      </li>
</template>
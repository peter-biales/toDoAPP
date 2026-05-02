<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import taskItem from '@/components/taskItem.vue';

const props = defineProps({
    tasks: Object
});

const form = useForm({
    title: '',
});

const tasksCount = computed(() => {
    let naming = '';
    switch(props.tasks?.length) {
        case 1:
            naming = ' úloha';
            break;
        case 2:
        case 3:
        case 4:
            naming = ' úlohy';
            break;
        default:
            naming = ' úloh';
    }
    return props.tasks?.length + naming;
});

function addTask() {
    form.post('/add', {
        onSuccess: () => form.reset(),
    });
}
</script>

<template>
    <Head title="ToDo APP"></Head>
    <main class="mx-auto flex min-h-screen w-full max-w-2xl items-start px-4 py-8 sm:py-12">
        <section class="w-full rounded-lg border border-slate-200 bg-white p-4 shadow-sm sm:p-6">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold">To-do list</h1>
                    <p id="counter" class="mt-1 text-sm text-slate-500">{{ tasksCount }}</p>
                </div>
            </div>
            <div id="taskForm" class="mt-6 flex flex-col gap-3 sm:flex-row">
                <input
                    id="taskInput"
                    type="text"
                    maxlength="120"
                    autocomplete="off"
                    placeholder="Názov úlohy"
                    class="
                        min-w-0 flex-1 rounded-lg border border-slate-300 px-4 py-3 outline-none transition
                        focus:border-blue-600 focus:ring-4 focus:ring-blue-100"
                    v-model="form.title"
                    @keyup.enter="addTask"
                />
                <button
                    class="
                        rounded-lg bg-blue-700 px-5 py-3 font-semibold text-white transition
                        hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-100"
                    @click="addTask"
                >
                    Pridať
                </button>
            </div>
            <ul
                id="taskList"
                class="mt-5 divide-y divide-slate-200"
                v-for="task in tasks"
                :key="task.id"
            >
                <taskItem :task="task"/>
            </ul>
        </section>
    </main>
</template>
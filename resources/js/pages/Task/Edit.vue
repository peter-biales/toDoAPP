<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    task: Object
});

const form = useForm({
    title: props.task?.title
});

</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <input v-model="form.title" type="text"/> <- task
</template>
<template>
    <div>
        <h1>Contatore: {{ count }}</h1>
        <button @click="increment">Incrementa</button>
        <button @click="decrement">Decrementa</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            count: 0,
        }
    },
    methods: {
        increment() {
            this.count++;
        },
        decrement() {
            this.count--;
        },
    },
}
</script>

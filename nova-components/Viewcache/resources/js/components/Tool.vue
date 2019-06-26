<template>
    <div>
        <heading class="mb-6">Viewcache</heading>

        <card class="flex flex-col items-center justify-center" style="min-height: 300px">

            <h1 class="text-black text-4xl text-90 font-light mb-6">Enable your Application View Cache</h1>

            <!-- <p class="text-white-50% text-lg">
                Enable your Application View Cache
                <code
                    class="ml-1 border border-80 text-sm font-mono text-white bg-black rounded px-2 py-1"
                    >/nova-components/Viewcache/resources/js/components/Tool.vue</code
                >
            </p> -->
            
            <button @click="activateCache" class="btn btn-default btn-primary">Enable Cache</button>
        </card>
    </div>
</template>

<script>
export default {
    methods: {
        activateCache() {
            Nova.request().post('/nova-vendor/viewcache')
                .then(response => {
                    alert('success')
                })
        }
    }
}
</script>

<style>
/* Scoped Styles */
</style>

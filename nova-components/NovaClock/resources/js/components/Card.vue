<template>
    <card class="flex flex-col items-center justify-center">
        <!-- <div class="px-3 py-3">
            <h1 class="text-center text-3xl text-80 font-light">Nova Clock</h1>
        </div> -->
        <digital-clock :blink="card.blink" :displaySeconds="card.displaySeconds" />
    </card>
</template>

<script>
import DigitalClock from "vue-digital-clock";
export default {
    components: {
        DigitalClock
    },
    props: [
        'card',

        // The following props are only available on resource detail cards...
        // 'resource',
        // 'resourceId',
        // 'resourceName',
    ],

    mounted() {
        //
    },
}
</script>

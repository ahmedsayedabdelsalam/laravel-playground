Nova.booting((Vue, router, store) => {
    Vue.component('index-string-limit', require('./components/IndexField'))
    Vue.component('detail-string-limit', require('./components/DetailField'))
    Vue.component('form-string-limit', require('./components/FormField'))
})

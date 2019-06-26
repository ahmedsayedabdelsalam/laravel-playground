Nova.booting((Vue, router, store) => {
    router.addRoutes([
        {
            name: 'viewcache',
            path: '/viewcache',
            component: require('./components/Tool'),
        },
    ])
})

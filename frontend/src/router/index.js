import Vue from 'vue'
import Router from 'vue-router'
import { store } from '@/main.js'
import auth from '@/middleware/auth'
import Layout from '@/views/layout.vue'
Vue.use(Router)
const router = new Router({
	mode: 'history',
	scrollBehavior(to) {
        if (to.hash) {
            return window.scrollTo({ top: document.querySelector(to.hash).offsetTop, behavior: 'smooth' });
        }
        return window.scrollTo({ top: 0, behavior: 'smooth' });
    },
	routes: [
		{
			path: '/',
			meta : {
				middleware : [auth],
			},
			component: Layout,
			children : [
				{
					path : '',
					name : 'Dashboard',
					meta : {
						middleware : [auth]
					},
					component: () => import('@/views/dashboard/index.vue'),
				},
			]
		},
		{
			path: '/login',
			name: 'Login',
			meta : {
				layout: 'auth'
			},
			component: () => import('@/views/auth/index.vue'),
		},
		{
			path: '*',
			name: '404',
			meta: {
				layout: 'error'
			},
			component: () => import('@/views/error/error-404.vue')
		},
	]
})


router.beforeEach( async (to, from, next) => {
	if (to.meta.middleware) {
		const middleware = to.meta.middleware
        const context = { next , from , to , router, store };
		var preventNext = false
		for (let i = 0; i < middleware.length; i++) {
			const result = await middleware[i](context);
			if( !result ){
				preventNext = true
				break
			}
		}
		if( preventNext ){
			return;
		}
	}
	return next()
});

export default router
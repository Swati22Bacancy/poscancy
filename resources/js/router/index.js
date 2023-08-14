import { createRouter, createWebHistory } from 'vue-router';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { path: '/', redirect: '/login' },
    {
      path: '/',
      component: () => import('../layouts/default.vue'),
      children: [
        {
          path: 'dashboard',
          meta: { requiresAuth: true },
          component: () => import('../pages/dashboard.vue'),
        },
        {
          path: 'profile',
          meta: { requiresAuth: true },
          component: () => import('../pages/profile.vue'),
        },
        {
          path: 'posts',
          meta: { requiresAuth: true },
          component: () => import('../pages/posts.vue'),
        },
        {
          path: 'create-post',
          meta: { requiresAuth: true },
          component: () => import('../pages/createpost.vue'),
        },
        {
          path: 'edit-post/:id',
          name:'editpost',
          meta: { requiresAuth: true },
          component: () => import('../pages/editpost.vue'),
        },
        {
          path: 'account-settings',
          component: () => import('../pages/account-settings.vue'),
        },
        {
          path: 'typography',
          component: () => import('../pages/typography.vue'),
        },
        {
          path: 'icons',
          component: () => import('../pages/icons.vue'),
        },
        {
          path: 'cards',
          component: () => import('../pages/cards.vue'),
        },
        {
          path: 'tables',
          component: () => import('../pages/tables.vue'),
        },
        {
          path: 'form-layouts',
          component: () => import('../pages/form-layouts.vue'),
        },
      ],
    },
    {
      path: '/',
      component: () => import('../layouts/blank.vue'),
      children: [
        {
          path: 'login',
          component: () => import('../pages/login.vue'),
        },
        {
          path: 'register',
          component: () => import('../pages/register.vue'),
        },
        {
          path: '/:pathMatch(.*)*',
          component: () => import('../pages/[...all].vue'),
        },
      ],
    },
  ],
})

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !localStorage.getItem('token')) {
    next('/');
  } else {
    next();
  }
});

export default router

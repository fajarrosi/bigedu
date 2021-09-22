
const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', name:'home', component: () => import('pages/Index.vue') },
      { path: 'blog', name:'blog', component: () => import('pages/Blog.vue') },
      { path: 'mentor', name:'mentor', component: () => import('pages/Mentor.vue') },
      { path: 'masuk', name:'masuk', component: () => import('pages/Login.vue') },
      { path: 'daftar', name:'daftar', component: () => import('pages/Register.vue') },
      { path: 'webinar', name:'webinar', component: () => import('pages/Webinar.vue')},
      { path: 'webinar/:id', name:'webinar-detail', component: () => import('pages/WebinarDetail.vue')},
      { path:'otp', component: () => import('pages/Otp.vue')},
    ]
  },
  {
    path:'/testing', component: () => import('layouts/BaseLayout.vue')
  },
  

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    name:'all',
    component: () => import('pages/Error404.vue')
  }
]

export default routes

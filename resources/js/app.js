window.Vue = require('vue');
require('./pages/theme');
require('./pages/article/create_edit_article');
require('./pages/article/create_edit_page');
require('./pages/article/index_article');
require('./pages/category/create_edit_category');
require('./pages/category/index_category');
require('./pages/setting/menu');
require('./pages/setting/setting_site');
require('./pages/user/index_user');
require('./pages/advertising/index_advertising');
require('./pages/advertising/create_update_advertising');
require('./pages/product/create_update_product');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
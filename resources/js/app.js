import './bootstrap';
import { createApp } from 'vue'
import app from './app.vue'

import { library } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';

createApp(app).mount('#app')
library.add(fas);

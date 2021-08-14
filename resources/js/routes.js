import add from './components/add.vue';
import edit from './components/edit.vue';
import Userlist from './components/Userlist.vue';

export const routes = [
    {
        name: 'user',
        path: '/user',
        component:Userlist
    },
    {
        name: 'add',
        path: '/add',
        component:add
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component:edit
    }
]

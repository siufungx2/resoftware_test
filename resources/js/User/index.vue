<template>
    <UserList v-if="!showUserForm" @show-form="showForm" />
    <UserForm v-else :action="action" :userId="userId" :name="userName" :job="userEmail" :key="userId" />
</template>
<script>
import UserList from './list.vue';
import UserForm from './form.vue';
export default {
    name: 'UserIndex',
    data() {
        return {
            showUserForm: false, // Show form when create or edit user
            action: '',
            userId: 0,
            userName: '',
            userEmail: '',
        };
    },
    components: {
        UserList,
        UserForm
    },
    methods: {
        showForm(action, userId, name, job) {
            this.action = action;
            this.userId = userId;
            this.userName = name;
            this.userEmail = job;
            console.log('Arguments:', action, userId, name, job); // Log the arguments
            this.showUserForm = true;
        }
    }
}
</script>

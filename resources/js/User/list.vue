<template>
  <div id="user_list">
    <h1>User List</h1>
    <div class="selects">
        <div class="page">
            Page:
            <select v-model="this.page">
                <option v-for="n in this.totalPage" :key="n">
                    {{ n }}
                </option>
            </select>
        </div>
        <div class="item_per_page">
            Item per page:
            <select v-model="this.perPage">
                <option v-for="n in 10" :key="n">
                    {{ n }}
                </option>
            </select>
        </div>
        <div class="create_user">
            <button @click="showForm('create', 0, '', '')">Create User</button>
        </div>
    </div>
    <div class="user_items">
        <div class="item" v-for="userItem in userItems" :key="userItem.id">
            <div class="avatar" :style="{ backgroundImage: 'url(' + userItem.avatar + ')' }"></div>
            <div class="userdetails">
                <div class="name">
                    {{ userItem.first_name }}
                    {{ userItem.last_name }}
                </div>
                <div class="email">
                    {{ userItem.email }}
                </div>
                <div class="action">
                    <FontAwesomeIcon icon="fa-solid fa-trash" @click="deleteUser(userItem.id)"/>&nbsp;
                    <FontAwesomeIcon icon="fa-solid fa-pen" @click="showForm('edit', userItem.id, userItem.first_name + userItem.last_name , userItem.email)"/>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
export default {
    name: 'UserList',
    components: {
        FontAwesomeIcon
    },
    data() {
        return {
            totalPage: 0,
            perPage: 6,
            page: 1,
            userItems: {}
        };
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            fetch(`/api/users?perPage=${this.perPage}&page=${this.page}`)
                .then(response => {
                if (!response.ok) {
                    throw new Error('Status code not ok (200)');
                }
                return response.json();
                })
                .then(data => {
                    this.totalPage = data.total_pages;
                    this.userItems = data.data;
                })
                .catch(error => {
                    console.error('API call error', error);
                });
        },
        deleteUser(userId) {
            fetch(`/api/user/${userId}`, {
                method: 'DELETE',
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to delete user');
                }
                console.log('User deleted successfully');
            })
            .catch(error => {
                console.error('Error deleting user:', error);
            });
        },
        showForm(action, userId, name, job) {
            this.$emit('show-form', action, userId, name, job); // Emit an event with arguments
        }
    },
    watch: {
        // User change per page from drop down
        perPage() {
            this.fetchData();
        },
        // User change page from drop down
        page() {
            this.fetchData();
        }
    },
}
</script>
<style scoped>
#user_list
{
    background-color: #cccccc;
    .selects
    {
        display: flex;
        align-items: center;
        button
        {
            margin: 4px;
            padding: 4px;
            background-color: #fcfcfc;
            border-radius: 10px;
        }
    }

    .user_items
    {
        display: grid;
        grid-gap: 10px;
        grid-template-columns: 1fr 1fr 1fr;
        grid-auto-columns: 1fr;
        /* grid-auto-rows: 100px; */
        border: 1px solid #c1c1c1;
        padding: 5px;

        .item
        {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 10px;
            display:flex;
            .avatar
            {
                width: 50px;
                height: 50px;
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                margin: 4px;
            }
            .email
            {
                flex: 1;
            }
        }
    }

    @media (max-width: 767px) {
        .user_items {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 479px) {
        .user_items {
            grid-template-columns: 1fr;
        }
    }
}
</style>

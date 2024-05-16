<template>
    <form>
        <input type="hidden" name="userid" :value="localUserId" />
        <div class="name"><input type="text" name="name" placeholder="name" v-model="localName" /></div>
        <div class="job"><input type="text" name="job" placeholder="job" v-model="localJob" /></div>
        <div class="action">
            <button @click="formSubmit"> {{ action }}</button>
        </div>
    </form>
</template>

<script>
export default {
    name: 'UserForm',
    props: {
        action: {
            type: String,
            default: 'Create',
        },
        userId: {
            type: Number,
        },
        name: {
            type: String,
        },
        job: {
            type: String,
        }
    },
    data() {
        return {
            localUserId: this.userId,
            localName: this.name,
            localJob: this.job
        };
    },
    methods: {
        formSubmit()
        {
            const payload = {
                name: this.localName,
                job: this.localJob,
            };
            // 0 = create user
            if (this.localUserId !== 0)
            {
                // Update user api call
                this.updateUser(this.localUserId, payload)
            } else {
                // create user
                this.createUser(payload)
            }
            console.log(this.localUserId, this.localName, this.localJob)
        },
        updateUser(userId, payload) {
            fetch(`/api/user/${userId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(payload)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to update user');
                }
                console.log('User updated successfully');
            })
            .catch(error => {
                console.error('Error updating user:', error);
            });
        },
        createUser(payload) {
            fetch(`/api/user`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(payload)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to create user');
                }
                console.log('User create successfully');
            })
            .catch(error => {
                console.error('Error create user:', error);
            });
        }
    }
}
</script>

<style scoped>
form
{
    padding: 10px;
    background-color: #cfcfcf;
    width: 100%;

    div
    {
        width: 50%;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 10px;
        input
        {
            width: 100%;
            border: #000000;
            border-radius: 5px;
            padding: 4px;
        }

    }

    button
    {
        width: 100%;
        text-align: center;
        padding: 4px;
        background-color: #f0f0f0;
        border-radius: 5px;
    }
}
</style>

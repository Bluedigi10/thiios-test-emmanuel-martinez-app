<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, onMounted } from 'vue';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const users = ref([]);
const isLoading = ref(false);

const fetchUserData = async () => {
  try {
    isLoading.value = true;
    if (users.value.length > 0) {
      users.value = [];
    }
    const response = await fetch(route('users.get')); // Replace with your API endpoint
    if (!response.ok) {
      throw new Error('Failed to fetch user data');
    }
    users.value = await response.json();
  } catch (error) {
    console.error(error);
  } finally {
    isLoading.value = false;
  }
};

const deleteUser = async (userId) => {
    try {
        isLoading.value = true;
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        const response = await fetch(route('profile.destroyA', userId), {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
            },
        });

        console.log('API Response:', response); // Log the response

        if (!response.ok) {
            throw new Error('Failed to delete user');
        } else {
            fetchUserData();
        }

        console.log('User deleted successfully');
    } catch (error) {
        console.error(error);
    } finally {
        isLoading.value = false;
    }
};

</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Users</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 cursor-pointer">
                        <PrimaryButton @click="fetchUserData">
                            Click here to show users registered
                        </PrimaryButton>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="relative overflow-x-auto">
                    <div v-if="isLoading" class="text-gray-500">
                        Loading...
                    </div>
                    <table v-else class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">Nombre</th>
                                <th scope="col" class="px-6 py-3">Correo</th>
                                <th scope="col" class="px-6 py-3">BORRAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user in users" :key="user.id">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{user.id}}</th>
                                <td class="px-6 py-4">{{user.username}}</td>
                                <td class="px-6 py-4">{{user.email}}</td>
                                <td class="px-6 py-4">
                                    <DangerButton
                                        class="ms-3"
                                        @click="deleteUser(user.id)"
                                    >
                                        BORRAR
                                    </DangerButton>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
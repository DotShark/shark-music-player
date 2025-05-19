<script>
export default {
    name: 'Index',

    data() {
        return {
            firstName: 'John',
            lastname: 'Doe'
        };
    },

    computed: {
        fullName() {
            return `${this.firstName} ${this.lastname}`;
        }
    },
};
</script>

<template>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12">
        <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
            <h1 class="text-5xl font-bold text-center text-gray-800 dark:text-white mb-8">Hello {{ fullName }}!</h1>
            <h2 class="text-2xl text-gray-600 dark:text-gray-300 mb-6 text-center">Try to edit the first name and the last name</h2>
            
            <div class="space-y-6">
                <div class="flex flex-col gap-2">
                    <label for="firstName" class="text-sm font-medium text-gray-700 dark:text-gray-200">First Name</label>
                    <input 
                        type="text" 
                        id="firstName" 
                        v-model="firstName"
                        class="px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-gray-900 dark:text-white"
                    />
                </div>
                <div class="flex flex-col gap-2">
                    <label for="lastName" class="text-sm font-medium text-gray-700 dark:text-gray-200">Last Name</label>
                    <input 
                        type="text" 
                        id="lastName" 
                        v-model="lastname"
                        class="px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-gray-900 dark:text-white"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<template>
    <div class="flex justify-center items-center h-screen">
        <button
            @click="requestTravel"
            :disabled="loading"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
            {{ loading ? "Sending..." : "Request Travel" }}
        </button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
        };
    },
    methods: {
        async requestTravel() {
            this.loading = true;
            try {
                const response = await fetch("/travel-request", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                    body: JSON.stringify({}),
                });

                if (response.ok) {
                    const data = await response.json();
                    console.log("Travel request sent:", data);
                    alert("Travel request sent!");
                } else {
                    console.error("Error sending request");
                    alert("Error sending travel request.");
                }
            } catch (error) {
                console.error("Error:", error);
                alert("Something went wrong.");
            } finally {
                this.loading = false;
            }
        },
    },
};
</script>

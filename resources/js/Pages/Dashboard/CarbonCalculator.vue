<template>
    <h2 class="text-xl font-bold mb-4 text-center">Carbon Footprint Calculator</h2>
    <div class="p-4">
        <div class="space-y-2">
            <p class="text-lg font-semibold">Perjalanan</p>
            <div v-for="(leg, index) in legs" :key="index" class="mb-4 p-2 bg-gray-50 shadow-sm border rounded-lg">
                <div class="flex items-center space-x-4">
                    <div class="flex-grow">
                        <label class="block mb-1">Distance (km) to destination:</label>
                        <input type="number" v-model="leg.distance"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500" min="0">
                    </div>
                    <div class="flex-grow">
                        <label class="block mb-1">Vehicle Type:</label>
                        <select v-model="leg.vehicleType"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                            <option value="car">Car</option>
                            <option value="bus">Bus</option>
                            <option value="bike">Bike</option>
                            <option value="walk">Walk</option>
                        </select>
                    </div>
                    <div v-if="index > 0" class="flex items-center">
                        <button @click="removeLeg(index)"
                            class="p-2 ml-2 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none"><i
                                class="bx bx-trash"></i></button>
                    </div>
                </div>
            </div>

            <!-- Add new leg button -->
            <div class="mt-4">
                <button @click="addLeg" class="w-full border p-1 rounded-md hover:bg-gray-100"><i
                        class="bg-green-500 text-white rounded-full hover:bg-green-600 focus:outline-none bx bx-plus text-lg p-1"></i>
                    <span class="ml-2">Add Vehicle</span>
                </button>
            </div>
        </div>

        <div class="mt-4 flex items-center space-x-2">
            <label class="block mb-1">Number of Users:</label>
            <div class="relative">
                <input type="number" v-model="numberOfUsers"
                    class="w-30 px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500" min="1">
                <i class='bx bx-user absolute right-6 top-1/2 transform -translate-y-1/2 text-gray-400'></i>
            </div>
        </div>

        <div class="space-y-2">
            <p class="text-lg font-semibold">Penginapan</p>
            <div v-for="(ledging, index) in ledgings" :key="index"
                class="mb-4 p-2 bg-gray-50 shadow-sm border rounded-lg">
                <div class="flex items-center space-x-4">
                    <div class="flex-grow">
                        <label class="block mb-1">Days:</label>
                        <input type="number" v-model="ledging.days"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500" min="0">
                    </div>
                    <div class="flex-grow">
                        <label class="block mb-1">Type:</label>
                        <select v-model="ledging.type"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                            <option value="homestay">Homestay</option>
                            <option value="hotel">Hotel</option>
                        </select>
                    </div>
                    <div v-if="index > 0" class="flex items-center">
                        <button @click="removeLedgings(index)"
                            class="p-2 ml-2 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none"><i
                                class="bx bx-trash"></i></button>
                    </div>
                </div>
            </div>

            <!-- Add new leg button -->
            <div class="mt-4">
                <button @click="addLedgings" class="w-full border p-1 rounded-md hover:bg-gray-100"><i
                        class="bg-green-500 text-white rounded-full hover:bg-green-600 focus:outline-none bx bx-plus text-lg p-1"></i>
                    <span class="ml-2">Add Ledging</span>
                </button>
            </div>
        </div>

        <div class="mt-5 flex justify-center">
            <button @click="calculateCarbonFootprint"
                class="w-1/2 bg-indigo-400 text-lg hover:bg-indigo-600 text-white px-5 py-2 rounded-md">Calculate</button>
        </div>

        <!-- Result section -->
        <div v-if="showResult" class="mt-5">
            <p class="text-lg font-semibold">Carbon Footprint Result:</p>
            <p class="text-xl font-bold">{{ carbonFootprintResult }} kg CO2</p>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

// Initial list of legs and ledgings
const legs = ref([
    { distance: 0, vehicleType: 'car' } // Initial leg
]);
const ledgings = ref([]);

// Number of users input
const numberOfUsers = ref(1);

// Result state
const showResult = ref(false);
const carbonFootprintResult = ref(0);

// Function to add a new leg
const addLeg = () => {
    legs.value.push({ distance: 0, vehicleType: 'car' });
};

// Function to add a new ledging
const addLedgings = () => {
    ledgings.value.push({ days: 1, type: 'hotel' });
};

// Function to remove a leg
const removeLeg = (index) => {
    legs.value.splice(index, 1);
};

// Function to remove a ledging
const removeLedgings = (index) => {
    ledgings.value.splice(index, 1);
};

// Function to calculate carbon footprint
const calculateCarbonFootprint = () => {
    let totalCarbonFootprint = 0;

    // Calculate carbon footprint from legs (travel)
    legs.value.forEach((leg) => {
        let emissionFactor = getEmissionFactor(leg.vehicleType); // Get emission factor based on vehicle type
        let legEmission = leg.distance * emissionFactor * numberOfUsers.value;
        totalCarbonFootprint += legEmission;
    });

    // Calculate carbon footprint from ledgings (accommodation)
    ledgings.value.forEach((ledging) => {
        let accommodationFactor = (ledging.type === 'homestay') ? 10 : 20; // Example factors for homestay and hotel
        let ledgingEmission = accommodationFactor * ledging.days * numberOfUsers.value;
        totalCarbonFootprint += ledgingEmission;
    });

    // Update result
    carbonFootprintResult.value = totalCarbonFootprint.toFixed(2);
    showResult.value = true;
};

// Function to get emission factor based on vehicle type (example implementation)
const getEmissionFactor = (vehicleType) => {
    switch (vehicleType) {
        case 'car':
            return 0.2; // Example emission factor for car in kg CO2 per km
        case 'bus':
            return 0.1; // Example emission factor for bus in kg CO2 per km
        case 'bike':
            return 0.05; // Example emission factor for bike in kg CO2 per km
        case 'walk':
            return 0; // Walking typically has negligible carbon footprint
        default:
            return 0;
    }
};
</script>

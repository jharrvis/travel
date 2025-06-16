<template>
  <aside class="sidebar">
    <div v-for="section in filters" :key="section.id" class="filter-section">
      <div class="filter-title" @click="section.open = !section.open">
        <span>{{ section.title }}</span>
        <svg class="arrow" viewBox="0 0 24 24">
          <path d="M8 10l4 4 4-4z" />
        </svg>
      </div>
      <div v-show="section.open" class="filter-content">
        <div class="filter-list">
          <div
            v-for="option in section.options"
            :key="option.name"
            class="filter-item"
            @click="toggleOption(section.id, option.name)"
          >
            <div class="filter-item-left">
              <div
                :class="[
                  'filter-checkbox',
                  isChecked(section.id, option.name) ? 'checked' : '',
                ]"
              ></div>
              <span class="filter-label">{{ option.name }}</span>
            </div>
            <span v-if="option.price" class="filter-price">{{
              option.price
            }}</span>
          </div>
        </div>
      </div>
    </div>
  </aside>
</template>

<script setup>
import { ref } from "vue";

const filters = ref([
  {
    id: "stops",
    title: "Stops",
    open: true,
    options: [
      { name: "Any", price: "", checked: true },
      { name: "Direct", price: "£1,409" },
      { name: "1 stop", price: "£1,459" },
    ],
  },
  {
    id: "departure",
    title: "Departure from",
    open: false,
    options: [
      { name: "Any", price: "", checked: true },
      { name: "London Gatwick", price: "£1,479" },
      { name: "Manchester", price: "£1,389" },
      { name: "Edinburgh", price: "£1,479" },
    ],
  },
  {
    id: "airlines",
    title: "Airlines",
    open: false,
    options: [
      { name: "Any", price: "", checked: true },
      { name: "AJet", price: "£1,459" },
      { name: "Saudia", price: "£1,389" },
      { name: "Turkish Airlines", price: "£1,479" },
    ],
  },
]);

const selectedOptions = ref({});

function toggleOption(sectionId, optionName) {
  selectedOptions.value[sectionId] = optionName;
}

function isChecked(sectionId, optionName) {
  return (
    selectedOptions.value[sectionId] === optionName ||
    (!selectedOptions.value[sectionId] && optionName === "Any")
  );
}
</script>

<style scoped>
.sidebar {
  width: 250px;
  padding-right: 20px;
  border-right: 1px solid #e0e0e0;
}
.filter-section {
  margin-bottom: 20px;
}
.filter-title {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-weight: 600;
  cursor: pointer;
  padding: 10px 0;
}
.filter-content {
  padding-left: 5px;
}
.filter-list {
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.filter-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  cursor: pointer;
}
.filter-checkbox {
  width: 16px;
  height: 16px;
  border: 1px solid #999;
  border-radius: 3px;
  margin-right: 10px;
}
.filter-checkbox.checked {
  background-color: #444;
}
.filter-item-left {
  display: flex;
  align-items: center;
}
.filter-price {
  font-size: 13px;
  color: #777;
}
</style>

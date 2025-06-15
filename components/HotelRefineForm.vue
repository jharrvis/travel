<template>
  <div class="section">
    <div class="section-header">Refine your holiday</div>
    <div class="section-content">
      <div class="form-field">
        <input
          type="text"
          :value="formData.airport"
          @click="$emit('edit-field', 'airport')"
          readonly
        />
      </div>

      <div class="form-field">
        <input
          type="text"
          :value="formData.nights"
          @click="$emit('edit-field', 'nights')"
          readonly
        />
      </div>

      <div class="form-field">
        <input
          type="text"
          :value="formData.boardBasis"
          @click="$emit('edit-field', 'boardBasis')"
          readonly
        />
      </div>

      <div class="form-field">
        <input
          type="text"
          :value="formData.rooms"
          @click="$emit('edit-field', 'rooms')"
          readonly
        />
      </div>

      <div class="form-field">
        <input
          type="text"
          :value="formData.flightTime"
          @click="$emit('edit-field', 'flightTime')"
          readonly
        />
      </div>

      <div class="guarantee-box">
        <div class="guarantee-icon">✓</div>
        <div class="guarantee-text">
          <div class="guarantee-title">{{ guarantee.title }}</div>
          <div>{{ guarantee.description }}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "HotelRefineForm",
  props: {
    formData: {
      type: Object,
      default: () => ({
        airport: "✈️ Any airport",
        nights: "🌙 5 nights",
        boardBasis: "🍽️ Any board basis",
        rooms: "👥 1 Room / 2 Adults",
        flightTime: "✈️ Any flight time",
      }),
    },
    guarantee: {
      type: Object,
      default: () => ({
        title: "Price Match Guarantee",
        description: "We won't be beaten on price",
      }),
    },
  },
  emits: ["edit-field", "guarantee-clicked"],
  methods: {
    handleGuaranteeClick() {
      this.$emit("guarantee-clicked", this.guarantee);
    },
  },
};
</script>

<style scoped>
.section {
  background: white;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  margin-bottom: 30px;
  overflow: hidden;
}

.section-header {
  padding: 20px;
  border-bottom: 1px solid #eee;
  font-size: 18px;
  font-weight: bold;
}

.section-content {
  padding: 20px;
}

.form-field {
  margin-bottom: 15px;
}

.form-field input {
  width: 100%;
  padding: 12px;
  border: 1px solid #ddd;
  border-radius: 6px;
  font-size: 14px;
  cursor: pointer;
  background: white;
  transition: border-color 0.2s, box-shadow 0.2s;
}

.form-field input:hover {
  border-color: #ac7872;
}

.form-field input:focus {
  outline: none;
  border-color: #ac7872;
  box-shadow: 0 0 0 2px rgba(172, 120, 114, 0.1);
}

.guarantee-box {
  background: #f8f9fa;
  padding: 15px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  gap: 10px;
  cursor: pointer;
  transition: background-color 0.2s;
}

.guarantee-box:hover {
  background: #e9ecef;
}

.guarantee-icon {
  color: #153b3c;
  font-size: 18px;
  font-weight: bold;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: white;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.guarantee-text {
  font-size: 14px;
}

.guarantee-title {
  font-weight: bold;
  margin-bottom: 2px;
  color: #153b3c;
}

@media (max-width: 768px) {
  .section-content {
    padding: 15px;
  }

  .form-field input {
    padding: 10px;
    font-size: 13px;
  }

  .guarantee-box {
    padding: 12px;
  }
}
</style>

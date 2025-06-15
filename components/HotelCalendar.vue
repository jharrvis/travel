<template>
  <div class="section">
    <div class="section-header">Price & Availability</div>
    <div class="calendar-section">
      <div class="calendar-header">
        <div class="selected-date">Selected Date: {{ selectedDateText }}</div>
      </div>

      <div class="month-navigation">
        <button class="nav-btn" @click="previousMonth">‹</button>
        <div class="month-year">{{ currentMonthText }}</div>
        <button class="nav-btn" @click="nextMonth">›</button>
      </div>

      <div class="calendar-grid">
        <div class="calendar-header-cell" v-for="day in dayHeaders" :key="day">
          {{ day }}
        </div>

        <div
          v-for="(day, index) in calendarDays"
          :key="index"
          class="calendar-cell"
          :class="{
            'other-month': day.otherMonth,
            selected: day.selected,
          }"
          @click="selectDate(day)"
        >
          <div class="date-number" v-if="day.day">{{ day.day }}</div>
          <div class="date-price" v-if="day.price">{{ day.price }}</div>
        </div>
      </div>

      <div class="price-toggle">
        <span>Price Per Person</span>
        <div
          class="toggle-switch"
          :class="{ active: showTotalPrice }"
          @click="togglePriceDisplay"
        ></div>
        <span>Total Price</span>
      </div>

      <div class="cheapest-indicator">
        <span>£</span>
        <span>= Cheapest</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "HotelCalendar",
  props: {
    initialSelectedDate: {
      type: Object,
      default: () => ({ day: 30, month: 10, year: 2025 }), // November 30, 2025
    },
  },
  emits: ["date-selected", "price-toggle"],
  data() {
    return {
      currentMonth: 10, // November (0-indexed)
      currentYear: 2025,
      selectedDate: { ...this.initialSelectedDate },
      showTotalPrice: false,
      dayHeaders: ["Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"],
      monthNames: [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
      ],
      dayNames: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
      // Sample price data - in real app this would come from props or API
      priceData: {
        "2025-10": {
          // November 2025
          1: "£2,019",
          2: "£1,999",
          3: "£1,759",
          4: "£1,749",
          5: "£1,749",
          6: "£1,729",
          7: "£1,779",
          8: "£1,769",
          9: "£1,579",
          10: "£1,599",
          11: "£1,559",
          12: "£1,559",
          13: "£1,559",
          14: "£1,599",
          15: "£1,579",
          16: "£1,599",
          17: "£1,579",
          18: "£1,569",
          19: "£1,559",
          20: "£1,559",
          21: "£1,579",
          22: "£1,599",
          23: "£1,599",
          24: "£1,599",
          25: "£1,569",
          26: "£1,559",
          27: "£1,569",
          28: "£1,509",
          29: "£1,509",
          30: "£1,459",
        },
      },
    };
  },
  computed: {
    currentMonthText() {
      return `${this.monthNames[this.currentMonth]} ${this.currentYear}`;
    },
    selectedDateText() {
      const date = new Date(
        this.selectedDate.year,
        this.selectedDate.month,
        this.selectedDate.day
      );
      const dayName = this.dayNames[date.getDay()];
      const monthName = this.monthNames[this.selectedDate.month];
      return `${dayName} ${this.selectedDate.day} ${monthName} ${this.selectedDate.year}`;
    },
    calendarDays() {
      const firstDay = new Date(this.currentYear, this.currentMonth, 1);
      const lastDay = new Date(this.currentYear, this.currentMonth + 1, 0);
      const startDate = new Date(firstDay);

      // Adjust to start on Monday (0 = Sunday, 1 = Monday, etc.)
      const dayOfWeek = (firstDay.getDay() + 6) % 7; // Convert Sunday=0 to Sunday=6
      startDate.setDate(startDate.getDate() - dayOfWeek);

      const days = [];
      const currentDate = new Date(startDate);

      // Generate 42 days (6 weeks)
      for (let i = 0; i < 42; i++) {
        const day = currentDate.getDate();
        const month = currentDate.getMonth();
        const year = currentDate.getFullYear();
        const isCurrentMonth =
          month === this.currentMonth && year === this.currentYear;
        const isSelected =
          this.selectedDate.day === day &&
          this.selectedDate.month === month &&
          this.selectedDate.year === year;

        const priceKey = `${year}-${month}`;
        const price = isCurrentMonth ? this.priceData[priceKey]?.[day] : null;

        days.push({
          day: day,
          month: month,
          year: year,
          otherMonth: !isCurrentMonth,
          selected: isSelected,
          price: price,
        });

        currentDate.setDate(currentDate.getDate() + 1);
      }

      return days;
    },
  },
  methods: {
    selectDate(day) {
      if (day.otherMonth || !day.day) return;

      // Update selected date
      this.selectedDate = {
        day: day.day,
        month: day.month,
        year: day.year,
      };

      // Emit event to parent
      this.$emit("date-selected", {
        date: this.selectedDate,
        price: day.price,
        dateText: this.selectedDateText,
      });
    },
    previousMonth() {
      this.currentMonth--;
      if (this.currentMonth < 0) {
        this.currentMonth = 11;
        this.currentYear--;
      }
    },
    nextMonth() {
      this.currentMonth++;
      if (this.currentMonth > 11) {
        this.currentMonth = 0;
        this.currentYear++;
      }
    },
    togglePriceDisplay() {
      this.showTotalPrice = !this.showTotalPrice;
      this.$emit("price-toggle", this.showTotalPrice);
    },
  },
  mounted() {
    // Emit initial selected date
    const initialDay = this.calendarDays.find((day) => day.selected);
    if (initialDay) {
      this.$emit("date-selected", {
        date: this.selectedDate,
        price: initialDay.price,
        dateText: this.selectedDateText,
      });
    }
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

.calendar-section {
  padding: 20px;
}

.calendar-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.selected-date {
  font-size: 16px;
  font-weight: bold;
}

.month-navigation {
  display: flex;
  align-items: center;
  gap: 15px;
  margin-bottom: 20px;
}

.nav-btn {
  background: none;
  border: 1px solid #ddd;
  border-radius: 50%;
  width: 35px;
  height: 35px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: background-color 0.2s;
}

.nav-btn:hover {
  background-color: #f5f5f5;
}

.month-year {
  font-size: 16px;
  font-weight: 500;
  min-width: 120px;
  text-align: center;
}

.calendar-grid {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  gap: 1px;
  background: #eee;
  border-radius: 8px;
  overflow: hidden;
  margin-bottom: 20px;
}

.calendar-header-cell {
  background: #f8f9fa;
  padding: 12px 8px;
  text-align: center;
  font-size: 14px;
  font-weight: 500;
  color: #666;
}

.calendar-cell {
  background: white;
  padding: 12px 8px;
  text-align: center;
  cursor: pointer;
  position: relative;
  min-height: 60px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  transition: background-color 0.2s;
}

.calendar-cell:hover:not(.other-month) {
  background: #f8f9fa;
}

.calendar-cell.selected {
  background: #153b3c;
  color: white;
}

.calendar-cell.other-month {
  color: #ccc;
  cursor: default;
}

.calendar-cell.other-month:hover {
  background: white;
}

.date-number {
  font-weight: bold;
  margin-bottom: 2px;
}

.date-price {
  font-size: 11px;
  color: #666;
}

.calendar-cell.selected .date-price {
  color: white;
}

.price-toggle {
  display: flex;
  align-items: center;
  gap: 10px;
  justify-content: center;
  margin-bottom: 20px;
}

.toggle-switch {
  width: 50px;
  height: 25px;
  background: #ddd;
  border-radius: 25px;
  position: relative;
  cursor: pointer;
  transition: background-color 0.3s;
}

.toggle-switch.active {
  background: #ac7872;
}

.toggle-switch::after {
  content: "";
  position: absolute;
  width: 21px;
  height: 21px;
  background: white;
  border-radius: 50%;
  top: 2px;
  left: 2px;
  transition: 0.3s;
}

.toggle-switch.active::after {
  left: 27px;
}

.cheapest-indicator {
  background: #153b3c;
  color: white;
  padding: 8px 12px;
  border-radius: 6px;
  font-size: 14px;
  font-weight: bold;
  display: flex;
  align-items: center;
  gap: 8px;
  justify-content: center;
}

@media (max-width: 768px) {
  .calendar-grid {
    font-size: 12px;
  }

  .calendar-cell {
    min-height: 50px;
    padding: 8px 4px;
  }

  .calendar-header {
    flex-direction: column;
    gap: 10px;
  }

  .month-navigation {
    justify-content: center;
  }
}
</style>

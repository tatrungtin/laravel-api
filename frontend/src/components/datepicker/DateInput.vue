<template>
  <div class="datepicker__input" @click="toggleDatepicker" @keyup.enter.stop.prevent="toggleDatepicker" data-qa="datepickerInput" :class="inputClass" v-text="inputDate ? inputDate : i18n[inputDateType]" :tabindex="tabIndex"></div>
</template>

<script>

export default {
  props: {
    isOpen: {
      type: Boolean,
      required: true,
    },
    inputDate: {
      type: String,
      default: null,
    },
    inputDateType: {
      type: String,
      default: 'check-in'
    },
    singleDaySelection: {
      type: Boolean,
      default: false,
    },
    toggleDatepicker: {
      type: Function,
      required: true,
    },
    showDatepicker: {
      type: Function,
      required: true,
    },
    i18n: {
      type: Object,
      required: true,
    },
  },

  computed: {
    inputClass() {
      return {
        'datepicker__input--is-active': this.isOpen && this.inputDate == null,
        'datepicker__input--single-date': this.singleDaySelection,
      };
    },
    tabIndex() {
      return this.inputDateType === 'check-in' ? 0 : -1;
    }
  },
};
</script>

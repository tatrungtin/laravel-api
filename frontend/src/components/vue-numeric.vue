<template>
	<input :placeholder="placeholder" @blur="onBlurHandler" @input="onInputHandler" @focus="onFocusHandler"
		@keyup.enter="onEnter" ref="numeric" type="tel" spellcheck="false" autocomplete="off" v-model="amount"
		v-if="!readOnly" :class="inputClass">
	<span v-else :class="readOnlyClass">{{ amount }}</span>
</template>

<script>
import accounting from 'accounting-js'
export default {
	props: {
		currency: {
			type: String,
			default: '',
			required: false
		},
		max: {
			type: Number,
			default: Number.MAX_SAFE_INTEGER || 9007199254740991,
			required: false,
		},
		min: {
			type: Number,
			default: Number.MIN_SAFE_INTEGER || -9007199254740991,
			required: false
		},
		minus: {
			type: Boolean,
			default: false,
			required: false
		},
		placeholder: {
			type: String,
			default: '',
			required: false
		},
		emptyValue: {
			type: [Number, String],
			default: '',
			required: false
		},
		precision: {
			type: Number,
			default: 0,
			required: false
		},
		separator: {
			type: String,
			default: ',',
			required: false
		},
		thousandSeparator: {
			default: undefined,
			required: false,
			type: String
		},
		decimalSeparator: {
			default: undefined,
			required: false,
			type: String
		},
		outputType: {
			required: false,
			type: String,
			default: 'Number'
		},
		value: {
			default: '',
			required: true,
			validator: (value) => {
				return value === null ||typeof value === 'number' || typeof value === 'string';
			}
		},
		inputClass :{
			type: String,
			default: 'form-control',
			required: false
		},
		readOnly: {
			type: Boolean,
			default: false,
			required: false
		},
		readOnlyClass: {
			type: String,
			default: 'form-control',
			required: false
		},
		currencySymbolPosition: {
			type: String,
			default: 'prefix',
			required: false
		},
		onEnter: {
			type: Function,
			required: false,
			default: () => {}
		},
		focusOnMouted: {
			type: Boolean,
			default: false
		}
	},
	data() {
		return {
			amount: '',
		}
	},
	computed: {
		amountNumber() {
			return this.unformat(this.amount)
		},
		valueNumber() {
			return this.unformat(this.value)
		},
		decimalSeparatorSymbol() {
			if (typeof this.decimalSeparator !== 'undefined') return this.decimalSeparator
			if (this.separator === ',') return '.'
			return ','
		},
		thousandSeparatorSymbol() {
			if (typeof this.thousandSeparator !== 'undefined') return this.thousandSeparator
			if (this.separator === '.') return '.'
			if (this.separator === 'space') return ' '
			return ','
		},
		symbolPosition() {
			if (!this.currency) return '%v'
			return this.currencySymbolPosition === 'suffix' ? '%v %s' : '%s %v'
		}
	},
	watch: {
		valueNumber(newValue) {
			if (this.$refs.numeric !== document.activeElement) {
				this.amount = this.format(newValue)
			}
		},
		readOnly(newValue, oldValue) {
			// if (oldValue === false && newValue === true) {
			// 	this.$nextTick(() => {
			// 		this.$refs.readOnly.className = this.readOnlyClass
			// 	})
			// }
		},
		separator() {
			this.process(this.valueNumber)
			this.amount = this.format(this.valueNumber)
		},
		currency() {
			this.process(this.valueNumber)
			this.amount = this.format(this.valueNumber)
		},
		precision() {
			this.process(this.valueNumber)
			this.amount = this.format(this.valueNumber)
		}
	},
	mounted() {
		if( this.value != ''){
			this.initialize(this.valueNumber)
			this.amount = this.format(this.valueNumber)
		}
		if ( !this.readOnly) {
			if (this.focusOnMouted) {
				setTimeout(() => {
					this.$refs.numeric.focus()
				}, 300)
			}
		}
	},
	methods: {
		initialize(value){
			if( value == '') return value
			if (value >= this.max) this.initializeUpdate(this.max)
			if (value <= this.min) this.initializeUpdate(this.min)
			if (value > this.min && value < this.max) this.initializeUpdate(value)
			if (!this.minus && value < 0) this.min >= 0 ? this.initializeUpdate(this.min) : this.initializeUpdate(0)
		},
		initializeUpdate(value) {
			if (value !== null) {
				const fixedValue = accounting.toFixed(value, this.getPrecision(value))
				const output = this.outputType.toLowerCase() === 'string' ? fixedValue : Number(fixedValue)
				if( value != output){
					this.$emit('input', output)
				}
			}
		},
		isNull(val) {
			if (val === undefined || val === null || val === '') {
				return true;
			}
			return false;
		},
		onBlurHandler(e) {
			if( this.value == '') return;
			this.$emit('blur', e)
			this.amount = this.format(this.valueNumber)
		},
		onFocusHandler(e) {
			this.$emit('focus', e)
			if( this.value == '') return;
			if (this.valueNumber === null) {
				this.amount = null
			} else {
				this.amount = accounting.formatMoney(this.valueNumber, {
					symbol: '',
					format: '%v',
					thousand: '',
					decimal: this.decimalSeparatorSymbol,
					precision: this.getPrecision(this.valueNumber)
				})
			}
		},
		onInputHandler() {
			this.process(this.amountNumber)
		},
		process(value) {
			if (value >= this.max) this.update(this.max)
			if (value <= this.min) this.update(this.min)
			if (value > this.min && value < this.max) this.update(value)
			if (!this.minus && value < 0) this.min >= 0 ? this.update(this.min) : this.update(0)
		},
		update(value) {
			if (value !== null) {
				const fixedValue = accounting.toFixed(value, this.getPrecision(value))
				const output = this.outputType.toLowerCase() === 'string' ? fixedValue : Number(fixedValue)
				this.$emit('input', output)
			}
		},
		format(value) {
			if (this.isNull(value)) {
				return null;
			}
			return accounting.formatMoney(value, {
				symbol: this.currency,
				format: this.symbolPosition,
				precision: this.getPrecision(value),
				decimal: this.decimalSeparatorSymbol,
				thousand: this.thousandSeparatorSymbol
			})
		},
		unformat(value) {
			const toUnformat = typeof value === 'string' && value === '' ? this.emptyValue : value
			if (toUnformat === null) {
				return null;
			}
			return accounting.unformat(toUnformat, this.decimalSeparatorSymbol)
		},
		isNumeric(value) {
			return value % 1 == 0
		},
		getPrecision(value) {
			if (this.isNumeric(value)) {
				return 0
			} else {
				var count = this.countDecimals(value)
				var current = Number(this.precision)
				if (count > current) {
					return current
				}
				return count
			}
		},
		countDecimals(value) {
			if ((value % 1) != 0)
				return value.toString().split(".")[1].length;
			return 0;
		},
	}
}
</script>

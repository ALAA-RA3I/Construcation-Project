# تدفق العقد - Contract Flow

## نظرة عامة

هذا النظام يطبق تدفقاً شاملاً لطلب وشراء الشقق، بدءاً من تقديم الطلب وحتى توقيع العقد النهائي على البلوك تشين.

## التدفق بالتفصيل

### 1. العميل يسجل الدخول ويقدم طلب شقة
- **النقطة**: `POST /api/propertyUnitOrder/create`
- **الحالة**: `pending`
- **الوصف**: العميل يقدم طلب شقة مع الملفات المطلوبة

### 2. مدير يوافق على الطلب
- **النقطة**: `PUT /api/contract-flow/{orderId}/approve`
- **الحالة**: `approved`
- **الإجراءات**:
  - تحديث حالة الطلب
  - إرسال إيميل تفعيل الحساب

### 3. تفعيل حساب العميل
- **النقطة**: `POST /api/contract-flow/activate-account`
- **البيانات**: `activation_token`
- **الإجراءات**:
  - تفعيل حساب العميل
  - إرسال إيميل العقد

### 4. إنشاء العقد
- **النقطة**: `POST /api/contract-flow/{orderId}/generate-contract`
- **الحالة**: `contract_ready`
- **الإجراءات**:
  - إنشاء ملف العقد
  - حفظ العقد في النظام

### 5. إرسال رمز التوقيع
- **النقطة**: `POST /api/contract-flow/{orderId}/send-signature-code`
- **الإجراءات**:
  - إنشاء رمز توقيع سري
  - إرسال الإيميل بالرمز

### 6. إنشاء Payment Intent
- **النقطة**: `POST /api/contract-flow/{orderId}/create-payment-intent`
- **البيانات**: `amount`
- **الحالة**: `payment_pending`
- **الإجراءات**:
  - إنشاء Stripe Payment Intent
  - إرجاع client_secret

### 7. تأكيد الدفع
- **النقطة**: `POST /api/contract-flow/{orderId}/confirm-payment`
- **البيانات**: `payment_intent_id`
- **الحالة**: `payment_completed`
- **الإجراءات**:
  - تأكيد الدفع مع Stripe
  - تحديث حالة الطلب

### 8. توقيع العميل
- **النقطة**: `POST /api/contract-flow/{orderId}/sign-by-client`
- **البيانات**: `signature_code`
- **الحالة**: `contract_signed`
- **الإجراءات**:
  - التحقق من رمز التوقيع
  - تسجيل توقيع العميل

### 9. توقيع الشركة
- **النقطة**: `PUT /api/contract-flow/{orderId}/sign-by-company`
- **الحالة**: `contract_finalized`
- **الإجراءات**:
  - توقيع الشركة
  - رفع العقد على البلوك تشين
  - إرسال إيميل التأكيد

## حالات الطلب (Status Enum)

```php
const Pending = 'pending';                    // في انتظار الموافقة
const Approved = 'approved';                  // تمت الموافقة
const Rejected = 'rejected';                  // مرفوض
const ContractReady = 'contract_ready';       // العقد جاهز
const PaymentPending = 'payment_pending';     // في انتظار الدفع
const PaymentCompleted = 'payment_completed'; // تم الدفع
const ContractSigned = 'contract_signed';     // تم توقيع العميل
const ContractFinalized = 'contract_finalized'; // تم توقيع الشركة
```

## الخدمات المستخدمة

### 1. EmailServiceService
- `sendAccountActivationEmail()` - إرسال إيميل تفعيل الحساب
- `sendContractEmail()` - إرسال إيميل العقد
- `sendSignatureCodeEmail()` - إرسال رمز التوقيع
- `sendContractFinalizedEmail()` - إرسال تأكيد اكتمال العقد

### 2. PaymentServiceService
- `createPaymentIntent()` - إنشاء Payment Intent
- `confirmPayment()` - تأكيد الدفع
- `retrievePaymentIntent()` - استرداد Payment Intent

### 3. ContractServiceService
- `generateContract()` - إنشاء ملف العقد
- `verifySignatureCode()` - التحقق من رمز التوقيع
- `signContractByClient()` - توقيع العميل
- `signContractByCompany()` - توقيع الشركة
- `uploadToBlockchain()` - رفع العقد على البلوك تشين

## قوالب البريد الإلكتروني

### 1. account-activation.blade.php
- تفعيل حساب العميل
- رابط التفعيل
- تفاصيل الطلب

### 2. contract-ready.blade.php
- إشعار جاهزية العقد
- تفاصيل الشقة
- خطوات التوقيع

### 3. signature-code.blade.php
- رمز التوقيع السري
- تحذيرات الأمان
- خطوات التوقيع

### 4. contract-finalized.blade.php
- تأكيد اكتمال العقد
- معلومات البلوك تشين
- رابط تحميل العقد

## الحقول الجديدة في قاعدة البيانات

### جدول property_unit_orders
```sql
-- حقول العقد
contract_file VARCHAR(255) NULL
contract_hash VARCHAR(255) NULL
contract_sent_at TIMESTAMP NULL

-- حقول التوقيع
signature_code VARCHAR(255) NULL
signature_code_sent_at TIMESTAMP NULL
client_signed_at TIMESTAMP NULL
company_signed_at TIMESTAMP NULL

-- حقول الدفع
payment_intent_id VARCHAR(255) NULL
payment_amount DECIMAL(12,2) NULL
payment_completed_at TIMESTAMP NULL

-- حقول إضافية
activation_token VARCHAR(255) NULL
activation_token_sent_at TIMESTAMP NULL
account_activated_at TIMESTAMP NULL
```

## الأمان

### 1. رموز التوقيع
- رموز عشوائية من 6 أحرف
- صالحة لمدة ساعة واحدة
- لا يمكن مشاركتها

### 2. البلوك تشين
- حفظ hash العقد
- حماية من التعديل
- إمكانية التحقق من الصحة

### 3. الدفع
- استخدام Stripe
- Payment Intent آمن
- تأكيد مزدوج

## الاستخدام

### للمدير
```bash
# الموافقة على طلب
PUT /api/contract-flow/{orderId}/approve

# إنشاء العقد
POST /api/contract-flow/{orderId}/generate-contract

# إرسال رمز التوقيع
POST /api/contract-flow/{orderId}/send-signature-code

# توقيع الشركة
PUT /api/contract-flow/{orderId}/sign-by-company
```

### للعميل
```bash
# تفعيل الحساب
POST /api/contract-flow/activate-account
{
    "activation_token": "token_here"
}

# إنشاء Payment Intent
POST /api/contract-flow/{orderId}/create-payment-intent
{
    "amount": 1000.00
}

# تأكيد الدفع
POST /api/contract-flow/{orderId}/confirm-payment
{
    "payment_intent_id": "pi_xxx"
}

# توقيع العقد
POST /api/contract-flow/{orderId}/sign-by-client
{
    "signature_code": "ABC123"
}
```

### مراقبة الحالة
```bash
# الحصول على حالة الطلب
GET /api/contract-flow/{orderId}/status
```

## التطوير المستقبلي

1. **إشعارات Push**: إضافة إشعارات فورية
2. **توقيع رقمي**: استخدام شهادات رقمية
3. **دفع متعدد**: دعم طرق دفع إضافية
4. **تحليلات**: إحصائيات وتقارير
5. **API للبلوك تشين**: ربط مع شبكات بلوك تشين حقيقية

## المتطلبات

- Laravel 10+
- PHP 8.1+
- MySQL/PostgreSQL
- Stripe Account
- Mail Configuration
- Storage Configuration

## التثبيت

1. تشغيل الـ migrations:
```bash
php artisan migrate
```

2. إعداد Stripe:
```env
STRIPE_KEY=your_stripe_publishable_key
STRIPE_SECRET=your_stripe_secret_key
```

3. إعداد البريد الإلكتروني:
```env
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email
MAIL_FROM_NAME="شركة العقارات"
```

4. إعداد Storage:
```bash
php artisan storage:link
``` 
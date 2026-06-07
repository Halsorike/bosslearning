# Brand Replacement Plan

## Goal
Replace all user-facing occurrences of `eSchool` and `Boss School` with `Boss Learning`, and replace `Boss School Staff` with `Boss Learning Staff`. Replace developer references containing `wrteam` with placeholders while preserving internal package names, database prefixes, and Firebase bundle identifiers.

## Replacement rules
- `Boss School` -> `Boss Learning`
- `Boss School Staff` -> `Boss Learning Staff`
- `eSchool` -> `Boss Learning`
- `wrteam` email addresses and developer URLs -> `#` or blank placeholders

## Exclusions
- Do not change Dart package names: `package:eschool` or `package:eschool_saas_staff`
- Do not change database prefixes: `eschool_saas_`
- Do not change bundle identifiers: `com.wrteam.*`
- Do not change Firebase config files: `google-services.json`, `GoogleService-Info.plist`
- Do not change anything inside `vendor/` or `node_modules/`

## Planned file updates

1. `database/seeders/AddSuperAdminSeeder.php`
  - Replace system_name, short_description, footer_text, and marketing text strings.

2. `.env.example`
  - Set `APP_NAME="Boss Learning"`

3. `app/Http/Controllers/Auth/LoginController.php`, `app/Jobs/SetupSchoolDatabase.php`
  - Replace fallback values for `system_name` from `Boss School` and `eSchool` to `Boss Learning`.

4. Blade/views and language files:
  - `resources/views/layouts/master.blade.php`
  - `resources/views/layouts/school/master.blade.php`
  - `resources/views/layouts/home_page/master.blade.php`
  - `resources/views/layouts/footer_js.blade.php`
  - `resources/views/school-website/index.blade.php`
  - `resources/views/school-website/about_us.blade.php`
  - `resources/views/subscription/index.blade.php`
  - `resources/views/addons/plan.blade.php`
  - `resources/views/home.blade.php`
  - `resources/views/students/admission_form.blade.php`
  - `resources/lang/en.json`

5. README and documentation files:
  - `README.md`

6. Flutter web metadata:
  - `flutter_student_app/web/index.html`
  - `flutter_student_app/web/manifest.json`

7. Flutter app display names:
  - `flutter_student_app/ios/Runner/Info.plist`
  - `flutter_staff_app/ios/Runner/Info.plist`
  - `flutter_student_app/android/app/src/main/AndroidManifest.xml`
  - `flutter_staff_app/android/app/src/main/AndroidManifest.xml`

8. `resources/views/layouts/master.blade.php` and any views defaulting to `Boss School`.

9. `flutter_student_app/lib/utils/constants.dart` and `public/.htaccess` for `wrteam` placeholder cleanup.

10. `.env` may remain unchanged because it is ignored and may contain environment-specific secrets, but `.env.example` will be updated.

## Audit output
Run `bash scripts/brand-audit.sh` to review exact file hits before applying changes.

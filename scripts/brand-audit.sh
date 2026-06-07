#!/usr/bin/env bash
set -euo pipefail
cd "$(dirname "$0")/.."

echo "Brand Audit Report"
echo "===================\n"

patterns=(
  'Boss School'
  'Boss Learning'
  'Boss School Staff'
  'eSchool'
  'wrteam'
)

for pat in "${patterns[@]}"; do
  echo "=== PATTERN: $pat ==="
  grep -RInE --exclude-dir=vendor --exclude-dir=node_modules --exclude-dir=.dart_tool --exclude-dir=build --exclude-dir=storage --exclude-dir=.git "$pat" . || true
  echo
 done

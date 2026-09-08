# Project agent guidance

## Frontend styling

- Use Tailwind utilities directly in Blade for layout, typography, colors, spacing, responsive behavior, and interaction states. Do not introduce custom component CSS classes for styling that utilities can express.
- Reuse Blade components when utility-heavy markup repeats. Keep custom CSS for font/theme declarations, keyframes, third-party integration, or behavior that genuinely cannot be expressed clearly with utilities.
- Preserve JavaScript hooks independently from styling, preferably with data attributes.

## Controllers

- Controllers must not contain private methods. Keep controllers focused on translating HTTP requests and responses, and move supporting behavior into an appropriately named action, query, builder, or other cohesive application boundary.

## Testing

- Use `jasonmccreary/double` for test doubles. Do not introduce direct Mockery mocks or Laravel facade spies; swap a Double-backed contract into the container or facade instead.

## Releases

- After a verified release, synchronize `develop` directly to `main` with a fast-forward-only merge and push. Never open a downstream pull request from `main` into `develop`.
- Never squash, rebase, create a merge commit, or force-push while synchronizing `develop` after a release.
- If branch protection blocks the direct synchronization, temporarily relax only the required-pull-request rule, restore it immediately after the push, and verify the protection is active again.

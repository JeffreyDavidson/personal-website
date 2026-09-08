import AxeBuilder from '@axe-core/playwright';
import { expect, test } from '@playwright/test';

for (const width of [390, 768, 1280]) {
    for (const colorScheme of ['light', 'dark'] as const) {
        test(`project detail at ${width}px in ${colorScheme} mode`, async ({ page }, testInfo) => {
            await page.setViewportSize({ width, height: 900 });
            await page.emulateMedia({ colorScheme, reducedMotion: 'reduce' });
            await page.goto('/projects/ringside');
            await expect(page.getByRole('heading', { level: 1, name: 'Ringside' })).toBeVisible();
            await expect(page.getByRole('link', { name: 'Explore the code' })).toHaveCount(0);
            await expect(page.locator('main a[href*="github.com"]')).toHaveCount(0);
            const dimensions = await page.evaluate(() => ({
                viewport: document.documentElement.clientWidth,
                content: document.documentElement.scrollWidth,
            }));
            expect(dimensions.content).toBeLessThanOrEqual(dimensions.viewport);
            const results = await new AxeBuilder({ page }).include('main').analyze();
            expect(results.violations.filter(({ impact }) => impact === 'serious' || impact === 'critical')).toEqual([]);
            await page.screenshot({ path: testInfo.outputPath('project-detail.png'), fullPage: true });
            await page.getByRole('link', { name: 'Discuss a similar project', exact: true }).click();
            await expect(page).toHaveURL(/\/contact$/);
        });
    }
}

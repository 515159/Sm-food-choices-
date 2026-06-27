% Plot radius vs refractive index from an index profile CSV file.
% The CSV format has two metadata rows, one header row, then numeric data.

[file, path] = uigetfile('*.csv', 'Select an index profile CSV file');

if isequal(file, 0)
    disp('No file selected.');
    return;
end

csvFile = fullfile(path, file);

% Skip the first two metadata rows and use the third row as column headers.
opts = detectImportOptions(csvFile, 'NumHeaderLines', 2);
opts.VariableNamingRule = 'preserve';
data = readtable(csvFile, opts);

radius = data.("Radius (mm)");
refractiveIndex = data.("Refractive Index");

% Remove any blank or nonnumeric rows, if present.
validRows = ~isnan(radius) & ~isnan(refractiveIndex);
radius = radius(validRows);
refractiveIndex = refractiveIndex(validRows);

figure('Color', 'w');
plot(radius, refractiveIndex, 'LineWidth', 2);
grid on;

xlabel('Radius (mm)');
ylabel('Refractive Index');
title('Radius vs Refractive Index');

% Save the chart beside the selected CSV file.
[~, name] = fileparts(file);
saveas(gcf, fullfile(path, [name '_radius_refractive_index.png']));
savefig(gcf, fullfile(path, [name '_radius_refractive_index.fig']));

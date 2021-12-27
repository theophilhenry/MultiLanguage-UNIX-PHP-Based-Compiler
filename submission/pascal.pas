program aaa;
var a,b,c,s,hasil,temphasil,test : double;
var num11, num12, num21, num22,num31, num32,loop,i: integer;
var akhir : array[0..10] of double;

begin
  readln(loop);
  for i:= 1 to 3 do
  begin
  readln(num11,num12);
  readln(num21,num22);
  readln(num31,num32);
  a := sqrt(((num21-(num11)) * (num21-(num11))) + ((num22-(num12)) * (num22-(num12))));
  b := sqrt(((num31-(num21)) * (num31-(num21))) + ((num32-(num22)) * (num32-(num22))));
  c := sqrt(((num31-(num11)) * (num31-(num11))) + ((num32-(num12)) * (num32-(num12))));


  s:=(a+b+c)/2;
  hasil:= sqrt(s*(s-a)*(s-b)*(s-c));
  akhir[i] := hasil;
  end;
  for i:= 1 to 3 do
  begin
  writeln(akhir[i]:0:5);
  end;
end.

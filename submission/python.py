import math

def hitung():
  A1=input().split();
  A2=input().split();
  A3=input().split();
  c=math.sqrt((int(A2[0])-int(A1[0]))**2+(int(A2[1])-int(A1[1]))**2);
  a=math.sqrt((int(A3[0])-int(A2[0]))**2+(int(A3[1])-int(A2[1]))**2);
  b=math.sqrt((int(A3[0])-int(A1[0]))**2+(int(A3[1])-int(A1[1]))**2);
  s=(a+b+c)/2;
  luas=math.sqrt(s*(s-a)*(s-b)*(s-c));
  Luas.append(luas);

Luas=[]
berapa=int(input());
for i in range(berapa):
  hitung()
for x in range(len(Luas)):
  print(Luas[x])